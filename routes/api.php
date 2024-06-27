<?php

use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\orderDetail;
use App\Http\Controllers\productController;
use App\Http\Controllers\productrevController;
use App\Http\Controllers\shipController;
use App\Http\Controllers\wishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//middleware authentication library sanctum


/*
//get current user token
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
*/

//Route::post('/logout', [userController::class, 'logout'])->middleware('auth:sanctum');
//Route::post('/register',[userController::class,'register']);

//Route::post('/login',[authController::class,'Login']);

//Route::apiResource("user",userController::class);//user Controller
//Route::apiResource("order",orderController::class); // order Controller
//Route::apiResource("order/detail",orderDetail::class); // order detail Controller




//Route::apiResource("product",productController::class); // product Controller

Route::put('api/user/{id}','userController@update');
Route::post('/register',[authController::class,'Register']);
Route::post('/loginn',[authController::class,'Loginn']);
Route::apiResource("category",categoryController::class); // category Controller
Route::middleware('auth:sanctum')->apiResource('product/rev',productrevController::class); //product rev Controller
Route::middleware('auth:sanctum')->apiResource("order/detail",orderDetail::class);
Route::middleware('auth:sanctum')->apiResource("order",userController::class);
Route::middleware('auth:sanctum')->apiResource("user",userController::class);
Route::middleware('auth:sanctum')->apiResource('ship/address',shipController::class);
Route::middleware('auth:sanctum')->apiResource('wish',wishController::class);
Route::middleware('auth:sanctum')->post('logout',[authController::class, 'logout']);
Route::post('add/fav',[wishController::class,'toggleFavourite']);
Route::apiResource("products", productController::class);

