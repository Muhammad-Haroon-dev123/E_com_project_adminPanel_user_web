<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (! isset($cart[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.',
            ], 404);
        }

        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        $itemTotal = $cart[$id]['price'] * $cart[$id]['quantity'];
        $grandTotal = collect($cart)->reduce(function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        return response()->json([
            'success' => true,
            'item_total' => $itemTotal,
            'grand_total' => $grandTotal,
        ]);
    }
}
