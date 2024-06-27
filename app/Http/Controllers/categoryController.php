<?php

namespace App\Http\Controllers;

use App\Http\Resources\categoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        $category = Category::with('products')->get();
        return response()->json($category);
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $category = Category::with('products')->find($id);
        return new categoryResource($category);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        
    }
}
