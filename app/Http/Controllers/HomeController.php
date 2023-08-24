<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request) {
        $categories = Category::all();
        $categoryName = $request->category;
        $query = Product::latest();
        if ($categoryName) {
            $query->whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            });
        }

        $products = $query->with('category')->paginate(16);

        $userCartItems=null;

        if(auth()->user()){
            $user=auth()->user();
            $userCartItems = $user->cartItems()->with('product')->get();

            if(count($userCartItems) ==0){
                $userCartItems =null;
            }
        }


        return view("pages.home")->with(["categories" => $categories, "products" => $products,"activeCategory"=>$request->category,"userCartItems"=>$userCartItems]);
    }



    public function productDetail($id){

      $product = Product::find($id);

        return view("pages.detail")->with(["product" => $product, ]);
    }

}
