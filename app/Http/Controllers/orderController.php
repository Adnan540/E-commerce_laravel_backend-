<?php

namespace App\Http\Controllers;

use App\Http\Resources\orderResource;
use App\Models\Order;
use App\Models\Order_Details;
use Illuminate\Http\Request;

class orderController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        $orders = Order::with('user.orderDetails')->where('user_id',$user->id)->get();
        return response()->json([
            'status'=>200,
            'orders'=> $orders,
            'message'=>"the order successfully"
            ]);
    }


    public function store(Request $request)
    {
        //store when create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total'=> $request->total
        ]);
        $order->save();
        $response = [
            'status' => 200,
            'order'=>$order,
            'message'=>"Order added succesfuly"
        ];
        return response()->json($response);
    }

    
    public function show($id)
    {
        $order=Order::with('user.orderDetails')->find($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $order = Order::find($id)->delete;
        return response("order has been deleted");
    }

    public function createOrder(Request $request)
    {
        $userId = auth()->user()->id;

        //retrieve input item from request
        $total = $request->input('total');
        $orderDetails = $request->input('order_details');

        $order = Order::create([
            'user_id' =>$userId,
            'total'=> $total
        ]);

        //create order details in order_detais table
        foreach($orderDetails as $detail){
            Order_Details::create([
                'order_id' => $order->id,
                'product_id'=>$detail['productId'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
            ]);
        }
        //Return success response
        return response()->json([
            'message'=>'order placed successfully'
        ]);

    }
}
