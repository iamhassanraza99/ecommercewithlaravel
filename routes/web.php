<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/admin/login',[AdminController::class,'index']);
Route::get('/',[AdminController::class,'index']);
// Route::get('/admin/encpassword',[AdminController::class,'encpassword']);
Route::post('/admin/login/auth',[AdminController::class,'auth']);

Route::group(['middleware'=>['LoginIsMust']], function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard']);

    #Categories
    Route::get('/admin/category',[CategoryController::class,'index']);
    // Route::get('/admin/category/new',[CategoryController::class,'new_category']);
    // Route::post('/admin/category/add',[CategoryController::class,'add_category'])->name('category.insert');

    Route::get('/admin/category/new',[CategoryController::class,'manage_category']);
    Route::post('/admin/category/manage_category',[CategoryController::class,'manage_category_process']);
    Route::get('/admin/category/edit/{id}',[CategoryController::class,'manage_category']);
    Route::get('/admin/category/delete/{id}',[CategoryController::class,'delete_category']);
    Route::get('/admin/category/status/{status}/{id}',[CategoryController::class,'status_category']);

    #Coupons
    Route::get('/admin/coupons',[CouponController::class,'index']);
    Route::get('/admin/coupons/new',[CouponController::class,'manage_coupon']);
    Route::post('/admin/coupons/manage_coupon',[CouponController::class,'manage_coupon_process']);
    Route::get('/admin/coupons/edit/{id}',[CouponController::class,'manage_coupon']);
    Route::get('/admin/coupons/delete/{id}',[CouponController::class,'delete_coupon']);
    Route::get('/admin/coupons/status/{status}/{id}',[CouponController::class,'status_coupon']);

    #Size
    Route::get('/admin/attributes/size',[SizeController::class,'index']);
    Route::get('/admin/attributes/size/new',[SizeController::class,'manage_size']);
    Route::post('/admin/attributes/size/manage_size',[SizeController::class,'manage_size_process']);
    Route::get('/admin/attributes/size/edit/{id}',[SizeController::class,'manage_size']);
    Route::get('/admin/attributes/size/delete/{id}',[SizeController::class,'delete_size']);
    Route::get('/admin/attributes/size/status/{status}/{id}',[SizeController::class,'status_size']);

    #Brand
    Route::get('/admin/attributes/brands',[BrandController::class,'index']);
    Route::get('/admin/attributes/brands/new',[BrandController::class,'manage_brand']);
    Route::post('/admin/attributes/brands/manage_brand',[BrandController::class,'manage_brand_process']);
    Route::get('/admin/attributes/brands/edit/{id}',[BrandController::class,'manage_brand']);
    Route::get('/admin/attributes/brands/delete/{id}',[BrandController::class,'delete_brand']);
    Route::get('/admin/attributes/brands/status/{status}/{id}',[BrandController::class,'status_brand']);

    #Color
    Route::get('/admin/attributes/color',[ColorController::class,'index']);
    Route::get('/admin/attributes/color/new',[ColorController::class,'manage_color']);
    Route::post('/admin/attributes/color/manage_color',[ColorController::class,'manage_color_process']);
    Route::get('/admin/attributes/color/edit/{id}',[ColorController::class,'manage_color']);
    Route::get('/admin/attributes/color/delete/{id}',[ColorController::class,'delete_color']);
    Route::get('/admin/attributes/color/status/{status}/{id}',[ColorController::class,'status_color']);

    #Tax
    Route::get('/admin/attributes/tax',[TaxController::class,'index']);
    Route::get('/admin/attributes/tax/new',[TaxController::class,'manage_tax']);
    Route::post('/admin/attributes/tax/manage_tax',[TaxController::class,'manage_tax_process']);
    Route::get('/admin/attributes/tax/edit/{id}',[TaxController::class,'manage_tax']);
    Route::get('/admin/attributes/tax/delete/{id}',[TaxController::class,'delete_tax']);
    Route::get('/admin/attributes/tax/status/{status}/{id}',[TaxController::class,'status_tax']);

    #Users
    Route::get('/admin/users',[UserController::class,'index']);
    Route::get('/admin/users/users_detail/{id}',[UserController::class,'users_detail']);
    Route::get('/admin/users/status/{status}/{id}',[UserController::class,'status_user']);

    #Products
    Route::get('/admin/products',[ProductController::class,'index']);
    Route::get('/admin/product/new',[ProductController::class,'manage_product']);
    Route::post('/admin/product/manage_product',[ProductController::class,'manage_product_process']);
    Route::get('/admin/product/edit/{id}',[ProductController::class,'manage_product']);
    Route::get('/admin/product/delete/{id}',[ProductController::class,'delete_product']);
    Route::get('/admin/product/status/{status}/{id}',[ProductController::class,'status_product']);
    Route::get('/admin/product/product_attr_delete/{product_attr_id}/{product_id}',[ProductController::class,'product_attr_delete']);
    Route::get('/admin/product/product_images_delete/{product_attr_id}/{product_id}',[ProductController::class,'product_images_delete']);

    


});

Route::get('/admin/logout',function(Request $request){
    $request->session()->forget('ADMIN_ID');
    return redirect('/admin/login');
});
