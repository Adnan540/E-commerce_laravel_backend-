<?php

namespace App\Http\Controllers;

use App\Http\Resources\wishResource;
use App\Models\Wishlist;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class wishController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wish = Wishlist::with(['user','products'])->where('user_id',$user->id)->get();
        $response = [
        'status' =>200,
        'wishlists'=>$wish,
        'message'=>"done"
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $wish = Wishlist::create([
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id
        ]);

        $response = [
            'status' => 200,
            'data' => $wish,
            'message' => 'item added successfully'
        ];

        return response()->json($response);
    }


    public function show($id)
    {
        $wish = Wishlist::with('user','products')->get()->find($id);
        return response()->json($wish);
    }

    public function update(Request $request, $id)
    {
        //validation
        $request->validate([
            'user_id' => 'integer',
            'product_id' => 'integer' 
        ]);
        //find id
        $wishlist = Wishlist::find($id);
        //update
        $wishlist->update([
            'user_id'=>$request->user_id ?? $wishlist->user_id,
            'product_id'=>$request->product_id ?? $wishlist->product_id
        ]);
        return response()->json($wishlist);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::with('user', 'products')->find($id);
        $wishlist->delete();
        $response = ['status' => 200, 'message' => 'the item deleted successfully'];
        return response()->json($response);
    }


    
    public function toggleFavourite(Request $request)
    {
        $wishlist = Wishlist::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            // If the wishlist item exists, delete it
            $wishlist->delete();
        } else {
            // If the wishlist item does not exist, create it
            $wishlist = Wishlist::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);
        }
        // $response = ['status' => 200, 'message' => 'the item deleted successfully'];
        return response()->json($wishlist);
    }

}
