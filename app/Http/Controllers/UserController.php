<?php
namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Pest\Support\View;
use Illuminate\Support\Facades\Auth;
// use Stripe\Climate\Order;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ShippingFee;
use Illuminate\Auth\Events\Validated;
use Nette\Utils\Random;
use App\Models\Contact;
use Faker\Provider\Payment;
use App\Mail\PaymentSuccess;
use App\Mail\OrderSuccess;
use App\Models\OrderCancel;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function index(){
      if(Auth::check()){
        if(Auth::user()->user_type=='user'){
             return view('dashboard');
        }
        else if(Auth::user()->user_type=='admin'){
            // $contact = Contact::all();
            return view('admin.dashboard');
        }
        }
      }
    function Home(){
    $products = Product::latest()->take(4)->get();
    return view('index', ['products'=>$products]);
      }
      
   public function productDetail($id){
    $product = Product::findorfail($id);
    return view('ProductDetail' , ['product'=>$product]);
}
public function AllProducts(){
    $products = Category::all();
    return view('AllProducts', ['products'=>$products]);
}
public function productsbycategory($id){
    $category = Category::where('id', $id)->get()->first()->name;
    $products = Product::where('category_id', $id)->get();
    return view('productsbycategory', ['products'=>$products , 'category'=>$category]);
}


public function AddToCart($id){
$user = auth()->user();
$cart = Cart::firstorCreate(['user_id'=> $user->id]);
$cartitem = $cart->CartItem()->where('product_id', $id)->first();
if($cartitem){
$cartitem->quantity +=1;
$cartitem->save();
}
else{
 $cart->CartItem()->create([
    'product_id'=>$id,
    'quantity'=>1,
 ]);
}

  return redirect()->back()->with('product_added_to_cart ','product added to cart successfully');

}


public function GetCart(){
    $user = auth()->user();
$cart = Cart::with('CartItem.Product')->where('user_id', $user->id)->first();
// $cartitem = $cart ? $cart->cartItems : collect();
    return view('cart',['cart'=>$cart]);
}

public function DeleteCartItem($id){
    $CartItem = CartItem::findorfail($id);
    $CartItem->delete();
    return redirect()->back()->with('CartItem_Deleted','CartItem Deleted Successfully');
}


public function order($id){
$cities = ShippingFee::pluck('city');
return view('orderaddress' , ['order'=>$id , 'cities'=>$cities]);
}

public function orderAddress(Request $request , $id){
    $cart = Cart::findorfail($id);
    $cartitems = CartItem::where('cart_id',$id)->with('Product')->get();
    $order = New Order;
    $order->user_id = $cart->user_id;
    $order->order_number = Random::generate(10);
    $order->subtotal =CartItem::totalamount($cart->id);
    $Validated = $request->validate([
        'shipping_address.name' => 'required|string|max:255',
        'shipping_address.phone' => 'required|string|max:20',
        'shipping_address.city' => 'required|string|max:255',
        'shipping_address.street' => 'required|string|max:255',
        'shipping_address.zip' => 'nullable|string|max:20',
]);
    $city = $Validated['shipping_address']['city'];
    $shippingfee = ShippingFee::where('city', $city)->first();
    $order->shipping_fee = $shippingfee->Shippingfee;
    $total = $order->subtotal + $shippingfee->Shippingfee;
    $order->total = $total;
    $order->shipping_address = $Validated['shipping_address'];
    $order->save();
foreach($cartitems as $item){
   $orderitem = New OrderItems();
   $orderitem->order_id = $order->id;
   $orderitem->product_id = $item->Product->id;
   $orderitem->quantity =$item->quantity;
   $orderitem->save();
}
return view('ordermethod' , ['order'=>$order]);
}

public function ordercomplete(Request $request ,$id){
$order = Order::findorfail($id);
$user = auth()->user();
$cart = Cart::where('user_id',$user->id)->with('CartItem.Product')->first();
if($request->payment_method == 'cod'){
    // $cartitems = CartItem::where('cart_id',$cart->id)->with('Product')->get();
    Mail::to($user->email)->send(new OrderSuccess($user->name , $order->order_number , $cart->CartItem, $request->payment_method));
    $cart->delete();
    $order->payment_method= 'cod';
    $order->order_status = 'confirmed';
    $order->payment_status = 'pending';
    $order->save();
    return redirect()->route('ordersucceess',$id)->with('orderPlaced', 'Order Placed Successfully');
}
else{
    Mail::to($user->email)->send(new OrderSuccess($user->name , $order->order_number , $cart->CartItem ,$request->payment_method ));
    $order->payment_method = 'card';
    $order->save();
    return redirect()->route('checkout',$id);
}
}

public function checkout($id){
// $cart = Cart::findorfail('user_id', $id);
$orderitems = OrderItems::where('order_id',$id)->with('Product')->get();
// $carttotal = CartItem::totalamount($id);
Stripe::setApiKey(env('STRIPE_SECRET'));
$lineItems = [];
foreach($orderitems as $item){
    $lineItems[] = [
    'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $item->Product->name,
                ],
                'unit_amount' => $item->Product->price * 100,
            ],
            'quantity' => $item->quantity,
        ];
}
$session = Session::create([
'payment_method_types' => ['card'],
'line_items'=> $lineItems,
'mode'=> 'payment',
 'success_url' => route('success', ['id' => $id]) . '?session_id={CHECKOUT_SESSION_ID}',
'cancel_url' => route('cancel'),
]
);
   return redirect($session->url);
// dd($carttotal);
}

public function ordersucceess($id){
    $user = auth()->user();
    $cart = Cart::where('user_id',$user->id);
    $cart->delete();
    $order= Order::findorfail($id);
$order->payment_status = 'cod';
$order->save();
    return view('orderSuccess');
}

public function success(Request $request, $id){
Stripe::setApiKey(env('STRIPE_SECRET'));
$sessionId = $request->get('session_id');
$session = Session::retrieve($sessionId);
$totalPaid = $session->amount_total; // cents
$totalPaidInDollars = $totalPaid / 100;
    $user = auth()->user();
    $order= Order::findorfail($id);
    $cart = Cart::where('user_id',$user->id)->with('CartItem.Product')->first();
    // $cartitems = CartItem::where('cart_id',$cart->id)->with('Product')->get();
    Mail::to($user->email)->send(new PaymentSuccess($user->name , $order->order_number , $cart->CartItem , $totalPaidInDollars));
    $cart->delete();
$order->payment_status = 'paid';
$order->order_status = 'confirmed';
$order->save();
return  view('success');
}

public function cancel(){
return view('cancel');
}

public function contactus(Request $request){
$Validated = $request->validate([
'name'=>'required|string|max:255',
'email'=>'required|email',
'phone'=>'required|integer',
'message'=>'required|string|max:4294967295',
]);
$contact = New Contact();
$contact->name= $Validated['name'];
$contact->email= $Validated['email'];
$contact->phone = $Validated['phone'];
$contact->message = $Validated['message'];
$contact->save();
return redirect()->back()->with('message_sent','message sent successfully');
}

public function yourorders(){
    $user = auth()->user();
    $orders = Order::where('user_id', $user->id)->with('OrderItem.Product')->get();
    return view('yourorders', compact('orders'));
}

public function CancelOrder($id){
$order = Order::with('User')->findorfail($id);
return view('cancelorder',['order'=>$order]);
}

public function postordercancel(Request $request , $id){
$validated = $request->validate([
'cancellation_reason'=>'required|string|max:255',
]);
$order = Order::findorfail($id);
$order->order_status = 'cancelled';
$order->save();
$ordercancel = New OrderCancel();
$ordercancel->order_id = $id;
$ordercancel->cancellation_reason = $validated['cancellation_reason'];
$ordercancel->cancelled_by = auth()->user()->id;
$ordercancel->save();
return redirect()->route('yourorders')->with('order_cancelled','Order Cancelled Successfully');
}
}
