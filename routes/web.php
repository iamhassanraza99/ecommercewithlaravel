<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
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


});

Route::get('/admin/logout',function(Request $request){
    $request->session()->forget('ADMIN_ID');
    return redirect('/admin/login');
});
