<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('orders','shippingAddresses','reviews','wishlist')->get();
        return response()->json($users);
    }
    
    /*____________________________________________________________*/

    public function show($id)
    {
        $user = User::with('orders','shippingAddresses','reviews','wishlist')->find($id);
        return response()->json($user);
    }

    /*__________________________________________________________*/

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "string|max:50|min:3",
            "email" => "email",
            "password" => "string|min:8"
        ]);

        $user = User::find($id);

        $user->update([
            "name" => $request->name ?? $user->name,
            "password" => $request->password ? bcrypt($request->password) : $user->password,
            "email" => $request->email ?? $user->email
        ]);
        $user->save();
        $response = [
            'status'=>200,
            'user'=>$user,
            'message'=>'updated successfully'
        ];
        return response()->json($response);
    }
    /*______________________________________________________*/

    public function destroy($id)
    {
        User::find($id)->delete();
        return response('User has been deleted');
    }

    /*_____________________________________________________________*/
    
    /*___________________________________________________________________*/

    public function logout(Request $request)
    {
        /** @var PersonalAccessToken $token */
        $token = Auth::user()->tokens->find($request->user()->currentAccessToken()->id);

        if ($token) {
            $token->delete();
        }

        return response()->json(['message' => 'Logged out successfully']);
    }

 

    }



