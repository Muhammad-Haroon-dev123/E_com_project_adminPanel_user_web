<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class shoppingCard extends Controller
{
    public function add(Request $request)
{
    $id = $request->product_id;

    $cart = session()->get('cart', []);

    $product = Admin::find($id);

    if(!$product){
        return back()->with('error', 'Product not found');
    }

    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $request->quantity;
    } else {
        $cart[$id] = [
            "name" => $product->product_name,
            "price" => $product->product_price,
            "image" => $product->product_image,
            "quantity" => $request->quantity
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Product added to cart');
}

// Cart show
public function index()
{
    $cart = session()->get('cart', []); 
    return view('user.shopping-cart', compact('cart'));

}

// Remove item
public function remove($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Item removed');
}
}
