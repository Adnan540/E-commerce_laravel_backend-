<?php

namespace App\Http\Controllers;

use App\Http\Resources\productResource;
use App\Http\Resources\productrevResource;
use App\Models\Product_Reviews;
use Illuminate\Http\Request;

class productrevController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        $productReview = Product_Reviews::with('user','product')->where('user_id',$user->id)->get();
        return response()->json([
            'status' => 200,
            'reviews' =>$productReview,
        ]);
    }

   
    public function store(Request $request)
    {
        $productReview = Product_Reviews::create([
            'product_id'=>$request->product_id,
            'user_id'=>$request->user_id,
            'review'=> $request->review,
            'rating'=>$request->rating
        ]);
        $productReview->save();
        $response =[
            'status'=>200,
            'reviews'=>$productReview,
            'message'=>'your review added successfuly'
        ];
        return response()->json($response);
    }

  
    
    public function show($product_id)
    {
        $productReview = Product_Reviews::with('user','product')->where('product_id',$product_id)->get();
        
        return response()->json([
            'status' => 200,
            'reviews' =>$productReview
        ]);
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
