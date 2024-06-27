<?php

namespace App\Http\Controllers;

use App\Http\Resources\productResource;
use Illuminate\Http\Request;
use App\Models\Product;



class productController extends Controller
{
    
    public function index()
    {
        $products = Product::with('orderDetails','category','reviews','wishlistUsers')->get(); 
        return response()->json([
            'status' => 200,
            'products' => $products,
        ]);
    }

    
    public function store(Request $request)
    {
        $product = Product::create(
            [
                'category_id'=>$request->category_id,
                'name'=> $request->name,
                'description'=> $request->description,
                'price'=> $request->price,
                'image'=>$request->image,
                'stock'=>$request->stock,
            ]);

            $product->save();
            return new productResource($product);
    }

    
    public function show($id)
    {
        $products = Product::with('orderDetails.category.reviews.wishlistUsers')->find($id);
        return response()->json([
            'status' => 200,
            'products' => $products
        ]);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $products= Product::find($id)->delete();
        return response('Product has been deleted');
    }
}
