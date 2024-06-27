<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    /*****Register function*******/
    function Register(Request $request)
    {

        try {
            $cred = new User();
            $cred->name = $request->name;
            $cred->email = $request->email;
            $cred->password = Hash::make($request->password);
            $cred->save();
            $response = [
                'status' => 200,
                'message' => 'Register Successfully Welcome'
            ];
            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'status' => 500,
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    /*****Login function*******/
    function Login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user != '[]' && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;
            $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login'];
            return response()->json($response);
        }

        //[] means empty
        else if ($user == '[]') {
            $response = ['status' => 500, 'message' => 'No account found with this email'];
        } else {
            $response = ['status' => 500, 'message' => 'Wrong email or password please try again later'];
            return response()->json($response);
        }
    }

    public function loginn(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != '[]' && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->name)->plainTextToken;
            $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Login done SUCCESSFULLY, welcome'];
            return response()->json($response);
        } else if ($user == '[]') {
            $response = ['status' => 500, 'message' => 'NO account found with this email '];
            return response()->json($response);
        } else {
            $response = ['status' => 500, 'message' => 'WRONG email or password, TRY again'];
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return 'tokens are deleted';
    }
}
