<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JWTAuth;

use App\Models\User;

class UserController extends Controller
{
    //

    public function register(Request $request){

        try {

            $user = new User([
                'name' => $request->form_user_name,
                'email' => $request->form_user_email,
                'password' => $request->form_passwprd
            ]);
            $user->save();
          
            $success = true;
            $message = "ລົງທະບຽນສຳເລັດ!";

        } catch (\Illuminate\Database\QueryException $ex) {
        
            $success = false;
            $message = $ex->getMessage();

        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);

    }

    public function login(Request $request){

        $user_login = [
            'email' =>$request->login_email,
            'password' => $request->login_password
        ];

        if($request->login_remember_me == 'true'){
            JWTAuth::factory()->setTTL(10080); // 60 = 1h
        }

        $token = JWTAuth::attempt($user_login);
        $user_data = Auth::user();

        if($token){

            $response = [
                'success' => true,
                'message' => 'ສຳເລັດ',
                'user_data' => $user_data,
                'token' => $token
            ];


        } else {

            $response = [
                'success' => false,
                'message' => 'ອີເມວລ໌ ຫຼື ລະຫັດຜ່ານບໍ່ຖຶກຕ້ອງ!'
            ];

        }

        return response()->json($response);

    }
}
