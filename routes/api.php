<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\TransectionController;
use App\Http\Controllers\API\BillController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::get('logout', [UserController::class,'logout']);

// Group api ທີ່ບໍ່ມີການກວດ token
// Route::controller(StoreController::class)->group(
//     function(){
//         Route::get('store','index');
//         Route::post('store/add','add');
//         Route::get('store/edit/{id}','edit');
//         Route::post('store/update/{id}','update');
//     }
// );

// Group api ທີ່ມີການກວດ Token
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('store',[StoreController::class,'index']);
        Route::post('store/add',[StoreController::class,'add']);
        Route::get('store/edit/{id}',[StoreController::class,'edit']);
        Route::post('store/update/{id}',[StoreController::class,'update']);
        Route::delete('store/delete/{id}',[StoreController::class,'delete']);
    }
);

Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::post('transection',[TransectionController::class,'index']);
        Route::post('transection/add',[TransectionController::class,'add']);
    }
);

Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('bills/print/{id}',[BillController::class,'print_bill']);
    }
);

// Route::get('bills/print/{id}', [BillController::class,'print_bill']);


