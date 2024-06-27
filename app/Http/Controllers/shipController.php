<?php

namespace App\Http\Controllers;

use App\Http\Resources\shipResource;
use App\Models\Shipping_Addresses;
use Illuminate\Http\Request;

class shipController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $shipAddress= Shipping_Addresses::with('user')->where('user_id',$user->id)->get();
        return $shipAddress;
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'address_line_1' => 'string',
            'address_line_2' => 'string',
            'city' => 'string',
            'state' => 'string',
            'zip_code' => 'string',
            'country' => 'string',
            'user_id' => 'integer',
        ]);

        $shipAddress = Shipping_Addresses::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'user_id' => $request->user_id,
        ]);
        return response()->json($shipAddress);
    }

    
    public function show($id)
    {
        $ship=Shipping_Addresses::with('user')->find($id);
        return new shipResource($ship);
    }

    
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
