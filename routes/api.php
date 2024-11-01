<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\StoreController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::get('logout', [UserController::class,'logout']);

// Group api ທີ່ບໍ່ມີການກວດ token

Route::controller(StoreController::class)->group(
    function(){
        Route::post('store/add','add');
    }
);




