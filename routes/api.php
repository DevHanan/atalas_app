<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\NotificationController;
use  App\Http\Controllers\Api\ForgotPasswordController;
use  App\Http\Controllers\Api\FavouriteController;
use  App\Http\Controllers\Api\OrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




    Route::get('about-us',[HomeController::class,'aboutUs']);
    Route::get('terms',[HomeController::class,'terms']);
    Route::get('cities',[HomeController::class,'city']);
    Route::get('district/{city_id}',[HomeController::class,'cityDistrict']);


    
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('update-fcm',[AuthController::class,'updateToken']);

    Route::get('settings',[HomeController::class,'settings']);
    Route::get('home',[HomeController::class,'home']);

   
    Route::get('sections',[HomeController::class,'sections']);
    Route::get('category-by-section/{id}',[HomeController::class,'CategoryBySection']);


    Route::get('product/{id}',[ProductController::class,'show']);
    Route::get('product-by-category/{id}',[ProductController::class,'ProductByCategory']);
    Route::get('list-recommend-products',[ProductController::class,'recommendProduct']);
    Route::get('list-top-rated-products',[ProductController::class,'topRatedProduct']);
    Route::get('list-best-selling-products',[ProductController::class,'bestSellingProduct']);
    Route::get('products',[ProductController::class,'list']);



    Route::middleware(['auth:sanctum'])->group(function (){



        Route::post('logout',[AuthController::class,'logout']);
        Route::post('delete-account',[ProfileController::class,'deleteaccount']);
        

        Route::post('product-rate',[ProductController::class,'rate']);

        
        /* Order Route */
        Route::get('order-list',[OrderController::class,'index']);
        Route::get('order/{id}',[OrderController::class,'show']);
        Route::post('order',[OrderController::class,'store']);

        
         Route::get('favourites-list',[FavouriteController::class,'index']);
        Route::get('favourite/{id}',[FavouriteController::class,'favourite']);
        
        
        Route::get('profile',[ProfileController::class,'index']);
        Route::post('profile',[ProfileController::class,'update']);
        Route::post('update-password',[ProfileController::class,'updatePassword']);
        
         Route::post('update-location',[ProfileController::class,'updateLocation']);

        /* Notification  */
        Route::get('list-notification',[NotificationController::class,'index']);
        Route::get('notification/change-status',[NotificationController::class,'changeStatus']);
        Route::get('notification/delete',[NotificationController::class,'delete']);
        Route::get('notification/delete-one/{id}',[NotificationController::class,'deleteOne']);
        Route::post('profile/notification/refresh-notification-token',[NotificationController::class,'refreshToken']);
    });

 Route::get('search',[HomeController::class,'search']);




