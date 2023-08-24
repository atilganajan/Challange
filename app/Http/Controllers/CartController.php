<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController
{
    public function addToCart(Request $request)
    {

        if (!auth() || auth()->user()->role_id != 2) {
            return response()->json(["status" => "error", "authorization error"]);
        }

        $user = auth()->user();

        $productData = Product::find($request->product_id);

        if (!$productData) {
            return response()->json(["status" => "error", "message" => "Product not found"]);
        }

        $cartItem = CartItem::create([
            "user_id" => $user->id,
            "product_id" => $request->product_id,
        ]);

        return response()->json(["status" => "success", "productData" => $productData,"cartItem"=>$cartItem, "Product added to cart"]);
    }

    public function removeItemToCart(Request $request)
    {

        if (!auth() || auth()->user()->role_id != 2) {
            return response()->json(["status" => "error", "authorization error"]);
        }


        $cartItem = CartItem::find($request->cart_item_id);

        if (!$cartItem) {
            return response()->json(["status" => "error", "message" => "Item not found"]);
        }

        $cartItem->delete();

        return response()->json(["status" => "success", "Item deleted to cart"]);
    }

}
