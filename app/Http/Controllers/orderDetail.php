<?php

namespace App\Http\Controllers;

use App\Http\Resources\orderDetailResource;
use App\Models\Order_Details;
use Illuminate\Http\Request;

class orderDetail extends Controller
{
   
    public function index()
    {
        $orderDetails = Order_Details::with('order','product')->get();
        return response()->json([
            'status'=>200,
            'orderDetails'=>$orderDetails,
            'message'=>'done'
        ]);
    }

    
    public function store(Request $request)
    {
        //on creating order_details
        $orderDetails = Order_Details::create([
            'order_id' =>$request->order_id,
            'product_id' =>$request->product_id,
            'quantity' => $request -> quantitny,
            'price' => $request-> price,
        ]);

        $orderDetails->save();
        $response = [
            'status' => 200,
            'order_details' => $orderDetails,
            'message' => 'the odrer details added successfully'
        ];
    }

    
    public function show($id)
    {
        $orderDetails = Order_Details::with('order,product')->get()->find($id);
        return response()->json($orderDetails);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $order= Order_Details::find($id)->delete();
        return response('order detail has been deleted');
    }
}
