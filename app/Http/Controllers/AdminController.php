<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\ShippingFee;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Replies;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyMail;
use App\Models\OrderCancel;

class AdminController extends Controller
{

    public function addCategory(){

        return view('admin.addcategory');
    }
     public function postaddCategory(Request $request){

        $validated = $request->validate([
            'name'=> 'required|max:255',
        ]);
        $category = new Category();
        $category->name = $validated['name'];
    if($request->hasFile('image')){
    $image = $request->file('image');
    $imagename = time() . '.'. $image->getClientOriginalExtension();
    // $image->move('productimage',$imagename);
    $image->storeAs('categoryimage', $imagename, 'public');
    $category->image =$imagename;
 }
        $category->save();

        return redirect()->back()->with('category_added','category added successfully');
    }
    public function analytics(){

        return view('admin.analytics');
    }
   public function ViewCategory(){
        $data = Category::all();
        return view('admin.viewcategory',['data'=>$data]);
    }
    public function EditCategory($id)
    {
        $category = Category::findorfail($id);
        return view('admin.updatecategory' ,['category'=>$category] );
    }
    public function postupdatecategory(Request $request , $id){
$validated = $request->validate([
    'name'=>'required|max:255',
]);
$category = Category::findorfail($id);
$category->name= $validated['name'];
  if($request->hasFile('image')){
    $image = $request->file('image');
    $imagename = time() . '.'. $image->getClientOriginalExtension();
    // $image->move('productimage',$imagename);
    $image->storeAs('categoryimage', $imagename, 'public');
    $category->image =$imagename;
 }
$category->save();
return redirect()->back()->with('category_updated','category updated successfully');
    }


public function deletecategory($id){
    $category = Category::findorfail($id);
    $category->delete();
    return redirect()->back()->with('category_deleted','category deleted successfully');
}

public function addProduct(){
    $category = Category::all();
return view('admin.addproduct', ['category'=>$category]);
}

public function postaddproduct(Request $request){

    $validated = $request->validate([
        'name'=>'required|max:255',
        'category'=>'required|exists:categories,id',
        'description'=>'required',
        'price'=>'required|numeric',
        'quantity'=>'required|integer',
        // 'image'=>'required|image|max:2048',
    ]);
 $product = new Product();

 $product->name = $validated['name'];
 $product->category_id = $validated['category'];
 $product->description =  $validated['description'];
 $product->price = $validated['price'];
 $product->quantity =$validated['quantity'];

 if($request->hasFile('image')){
    $image = $request->file('image');
    $imagename = time() . '.'. $image->getClientOriginalExtension();
    // $image->move('productimage',$imagename);
    $image->storeAs('productimage', $imagename, 'public');
    $product->image =$imagename;
 }
 $product->save();

 return redirect()->back()->with('product_added','product added successfully');
}


public function viewProduct(){
    $products = Product::all();
    return view('admin.viewProduct', ['products'=>$products]);
}

public function EditProduct($id){
    $product = Product::findorfail($id);
    $category = Category::all();
    return view('admin.editproduct',['product'=>$product , 'category'=>$category]);
}

public function postupdateproduct(Request $request , $id){

   $validated = $request->validate([
        'name'=>'required|max:255',
        'category'=>'required|exists:categories,id',
        'description'=>'required',
        'price'=>'required|numeric',
        'quantity'=>'required|integer',
        // 'image'=>'required|image|max:2048',
    ]);

$product = Product::findorfail($id);
//  $product->name = $request->input('name');
//  $product->category_id =$request->input('category');
//  $product->description =  $request->input('description');
//  $product->price = $request->input('price');
//  $product->quantity =$request->input('quantity');
 $product->name = $validated['name'];
 $product->category_id = $validated['category'];
 $product->description =  $validated['description'];
 $product->price = $validated['price'];
 $product->quantity =$validated['quantity'];
  if($request->hasFile('image')){
    $image = $request->file('image');
    $imagename = time() . '.'. $image->getClientOriginalExtension();
    // $image->move('productimage',$imagename);
    $image->storeAs('productimage', $imagename, 'public');
    $product->image =$imagename;
 }
 $product->save();

 return redirect()->back()->with('product_updated ','product updated successfully');
}

public function deleteproduct($id){
    $product = Product::findorfail($id);
    $product->delete();
    return redirect()->back()->with('product_deleted','product deleted successfully');
}
public function viewSearchProduct(Request $request){
    // dd($request->all());
    $search = $request->input('search');
// dd($search);
    $products = Product::where('name', 'like', '%' . $search . '%')->get();
    return view('admin.viewProduct', ['products' => $products]);
}


public function addShipping(){
return view('admin.addshipping');
}


public function postaddShipping(Request $request){
    // dd($request);
    $fee = $request->validate(
        [
            'city'=>'required|string|max:255',
            'Shippingfee' => 'required|integer',
        ] );
    // dd($fee);
    $shippingfee = New ShippingFee();
    $shippingfee->city = $fee['city'];
    $shippingfee->Shippingfee = $fee['Shippingfee'];
    $shippingfee->save();

   return redirect()->back()->with('shippingfee_saved','shipping fee saved successfully');
}
 public function ViewShipping(){
    $shippingfee = ShippingFee::all();
    return view('admin.viewshipping', ['shippingfee'=> $shippingfee]);
 }

 public function EditShipping($id){
    $shipping = ShippingFee::where('id',$id)->get()->first();
    return view('admin.editshipping',['shippingfee'=>$shipping]);
 }

 public function PostEditShipping(Request $request , $id){
    // dd($request->Shippingfee);
    $validated = $request->validate([
'city' => 'required|string|max:255',
'Shippingfee' =>'required',
    ]);

    $shippingfee = ShippingFee::findorfail($id);
    $shippingfee->city = $validated['city'];
    $shippingfee->Shippingfee = $validated['Shippingfee'];
    $shippingfee->save();
return redirect()->back()->with('shippingfee_updated','shipping fee updated successfully');
 }

 public function deleteshipping($id){
$shipping = ShippingFee::findorfail($id);
$shipping->delete();
return redirect()->back()->with('shippingfee_deleted','shipping fee deleted successfully');

 }

 public function Order(){
    $orders = Order::with('OrderItem.Product', 'User')->get();
    return view('admin.orders',['orders'=>$orders]);
 }

 public function deleteorder($id){
    $order = Order::findorfail($id);
    $order->delete();
    return redirect()->back()->with('order_Deleted', 'order Deleted SuccessFully');
 }
public function Users(){
    $users = User::all();
    return view('admin.users', ['users'=>$users]);
}
public function deleteuser($id){
$user = User::findorfail($id);
$user->delete();
return redirect()->back()->with('user_Deleted', 'user Deleted SuccessFully');
}

public function contact(){
    $contact = Contact::with('replies')->get();
    return view('admin.contact' , ['contact'=>$contact]);
}

public function deletemessage($id){
$message = Contact::findorfail($id);
$message->delete();
return redirect()->back()->with('message_deleted' , 'message deleted successfully');
}
public function sendreply($id){
    $contact = Contact::findorfail($id);
    return view('admin.sendreply' , ['contact' => $contact]);
}
public function postreply(Request $request , $id){
$validated = $request->validate([
    'subject'=>'required|string|max:255',
    'message'=>'required|string',
]);
$contact = Contact::findorfail($id);
Mail::to($contact->email)->send(new ReplyMail($validated['subject'],$validated['message'] ,$contact->name));
$reply = new Replies();
$reply->contact_id = $id;
$reply->subject = $validated['subject'];
$reply->message = $validated['message'];
$reply->save();
return redirect()->back()->with('reply_sent','reply sent successfully');
}
public function replies($id){
$contact = Contact::findorfail($id);
return view('admin.replies' , ['contact'=>$contact]);
}


public function cancelledorders(){
    $orders = OrderCancel::with('Order.User', 'Order.OrderItem.Product')->get();
    return view('admin.cancelledorders', ['orders'=>$orders]);
}


public function editorder($id){
 $order = Order::findorfail($id);
return view('admin.editorder', ['order'=>$order]);

}

public function posteditorder(Request $request , $id){
    $validated = $request->validate([
        'payment_status' => 'required|string|max:255',
         'order_status' => 'required|string|max:255',
    ]);

    $order = Order::findorfail($id);
    $order->payment_status = $validated['payment_status'];
    $order->order_status = $validated['order_status'];
    $order->save();

    return redirect()->back()->with('order_updated', 'Order updated successfully');
}
}
