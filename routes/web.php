<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
// Route::get('/', function () {
//     return view('index');
// })->name('index');
Route::get('/', [UserController::class ,'Home'])->name('index');
Route::get('/productDetail/{id}', [UserController::class ,'productDetail'])->name('productDetail');
Route::get('/AllProducts', [UserController::class ,'AllProducts'])->name('AllProducts');
Route::get('/productsbycategory/{id}', [UserController::class ,'productsbycategory'])->name('productsbycategory');


Route::get('/cancelorder/{id}', [UserController::class ,'CancelOrder'])->middleware(['auth', 'verified'])->name('cancel_order');
Route::post('/cancelorder/{id}', [UserController::class ,'postordercancel'])->middleware(['auth', 'verified'])->name('ordercancel');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [UserController::class ,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/get_cart', [UserController::class ,'GetCart'])->middleware(['auth', 'verified'])->name('get_cart');
Route::get('/add_to_cart/{id}', [UserController::class ,'AddToCart'])->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/deleteCartItem/{id}', [UserController::class ,'DeleteCartItem'])->middleware(['auth', 'verified'])->name('deleteCartItem');

Route::get('/order/{id}', [UserController::class ,'order'])->middleware(['auth', 'verified'])->name('order');
Route::post('/ordercomplete/{id}', [UserController::class ,'ordercomplete'])->middleware(['auth', 'verified'])->name('ordercomplete');
Route::post('/orderaddress/{id}', [UserController::class ,'orderAddress'])->middleware(['auth', 'verified'])->name('orderaddress');

Route::get('/ordersucceess/{id}', [UserController::class ,'ordersucceess'])->middleware(['auth', 'verified'])->name('ordersucceess');
Route::get('/checkout/{id}', [UserController::class ,'checkout'])->middleware(['auth', 'verified'])->name('checkout');
Route::get('/success/{id}', [UserController::class ,'success'])->middleware(['auth', 'verified'])->name('success');

Route::get('/cancel', [UserController::class ,'cancel'])->middleware(['auth', 'verified'])->name('cancel');
Route::post('/contactus', [UserController::class ,'contactus'])->middleware(['auth', 'verified'])->name('contactus');
Route::post('/contactus', [UserController::class ,'contactus'])->middleware(['auth', 'verified'])->name('contactus');
Route::get('/yourorders', [UserController::class ,'yourorders'])->middleware(['auth', 'verified'])->name('yourorders');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {

Route::get('/cancelledorders', [AdminController::class ,'cancelledorders'])->name('admin.cancelledorders');
Route::get('/replies/{id}', [AdminController::class ,'replies'])->name('admin.replies');
Route::post('/postreply/{id}', [AdminController::class ,'postreply'])->name('admin.postreply');
Route::get('/sendreply/{id}', [AdminController::class ,'sendreply'])->name('admin.sendreply');
Route::get('/analytics', [AdminController::class ,'analytics'])->name('admin.analytics');
Route::get('/add_product', [AdminController::class ,'addProduct'])->name('admin.addProduct');Route::post('/add_product', [AdminController::class ,'postaddproduct'])->name('admin.postaddproduct');
Route::get('/view_product', [AdminController::class ,'viewProduct'])->name('admin.viewProduct');
// Route::get('/view_product/{name}', [AdminController::class ,'viewProduct'])->name('admin.viewProduct');
Route::get('/edit_product/{id}', [AdminController::class ,'EditProduct'])->name('admin.editproduct');
Route::post('/edit_product/{id}', [AdminController::class ,'postupdateproduct'])->name('admin.postupdateproduct');
Route::get('/delete_product/{id}', [AdminController::class ,'deleteproduct'])->name('admin.deleteproduct');
// admin.viewProduct
Route::post('/view_Search_Product', [AdminController::class ,'viewSearchProduct'])->name('admin.viewSearchProduct');

Route::get('/add_shipping', [AdminController::class ,'addShipping'])->name('admin.addshipping');
Route::post('/add_shipping', [AdminController::class ,'postaddShipping'])->name('admin.postaddshipping');

Route::get('/view_shipping', [AdminController::class ,'ViewShipping'])->name('admin.viewshipping');
Route::get('/edit_shipping/{id}', [AdminController::class ,'EditShipping'])->name('admin.editshipping');

Route::post('/edit_shipping/{id}', [AdminController::class ,'PostEditShipping'])->name('admin.posteditshipping');

Route::get('/delete_shipping/{id}', [AdminController::class ,'deleteshipping'])->name('admin.deleteshipping');

Route::get('/add_category', [AdminController::class ,'addCategory'])->name('admin.addcategory');
Route::post('/add_category', [AdminController::class ,'postaddCategory'])->name('admin.postaddcategory');
Route::get('/view_category', [AdminController::class ,'ViewCategory'])->name('admin.viewcategory');
Route::get('/edit_category/{id}', [AdminController::class ,'EditCategory'])->name('admin.editcatagory');
Route::post('/edit_category/{id}', [AdminController::class ,'postupdatecategory'])->name('admin.postupdatecategory');
Route::get('/delete_category/{id}', [AdminController::class ,'deletecategory'])->name('admin.deletecategory');
Route::get('/order', [AdminController::class ,'Order'])->name('admin.order');
Route::get('/editorder/{id}', [AdminController::class ,'editorder'])->name('admin.editorder');
Route::post('/editorder/{id}', [AdminController::class ,'posteditorder'])->name('admin.posteditorder');
Route::get('/users', [AdminController::class ,'Users'])->name('admin.user');
Route::get('/deleteorder/{id}', [AdminController::class ,'deleteorder'])->name('admin.deleteorder');
Route::get('/deleteuser/{id}', [AdminController::class ,'deleteuser'])->name('admin.deleteuser');
Route::get('/contact', [AdminController::class ,'contact'])->name('admin.contact');
Route::get('/deletemessage/{id}', [AdminController::class ,'deletemessage'])->name('admin.deletemessage');

});



require __DIR__.'/auth.php';
