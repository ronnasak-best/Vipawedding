<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReturnProductsController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductAtrrController;
use App\Http\Controllers\BackEndOrderController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product',[IndexController::class ,'index'])->name('product');
Route::get('/howitwork',[IndexController::class ,'howitwork']);
Route::get('/test',[IndexController::class ,'test']);
Route::get('/about', function () {
    return view('frontend.about');
});
Route::get('/product-detail/{id}',[IndexController::class ,'detialpro']);
Route::get('/get-product-attr',[IndexController::class ,'getAttrs']);
Route::get('/cat/{id?}/{ss?}',[IndexController::class ,'listByCat'])->name('cats');

//cart
Route::resource('/cart',CartController::class);
//Route::resource('/category', CategoryController::class);
//Route::get('/cart/delete/{id}', 'CartController@destroy')->name('cart.destroy');

//address
Route::get('/province',[DistrictController::class ,'provinces']);
Route::get('/province/{province_code}/amphoe',[DistrictController::class ,'amphoes']);
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district',[DistrictController::class ,'districts']);
Route::get('/province/{province_code}/amphoe/{amphoe_code}/district/{district_code}',[DistrictController::class ,'detail']);


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::resource('/myaccount', AddressController::class);
    Route::resource('/check-out',CheckoutController::class);
    //Route::post('/payment','CheckoutController@payment');
    Route::resource('/orders', OrderController::class);
    //Route::post('/order_return','OrderController@upload_return')->name('order.return');
    //Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});


/** backend */
// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','admins'])->group(function () {
//     Route::resource('/products',ProductsController::class);
//     //Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
// });
Route::group(['prefix'=>'admin','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','admins']],function (){
    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');
    /// Category Area
    Route::resource('/category', CategoryController::class);
    // Route::get('category/delete/{id}', 'CategoryController@destroy');
    /// Product Area
    Route::resource('/products', ProductsController::class);
    // Route::get('product/delete/{id}', 'ProductsController@destroy');
    // /// Product Images
    Route::resource('/Image-gallery', GalleryController::class);
    // Route::get('Image-gallery/delete-Imagegallery/{id}', 'GalleryController@destroy');
    // /// product_atrr
    Route::resource('/product_atrr', ProductAtrrController::class);
    //Route::get('product_atrr/delete/{id}', 'ProductAtrrController@destroy');
    // //Order
    Route::resource('/orderss', BackEndOrderController::class);
    Route::get('orderss/cancel/{id}', [BackEndOrderController::class,'disPayment']);
    Route::get('orderss/payment_confirm/{id}', [BackEndOrderController::class,'payment_confirm']);
    // //ReturnPproducts
    Route::resource('/orders_re',ReturnProductsController::class);
    // //User
    // Route::resource('/user','UserController');

});


// Route::group(['middleware'=>'admins'],function(){
//     // Route::get('/users',User::class)->name('userManagement');
// });