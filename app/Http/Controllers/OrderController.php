<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->check() && auth()->user()->role === 'customer') {
            $cartItems = session()->get('cart', []);
            $grandTotal = 0;
            foreach ($cartItems as $item) {
                $grandTotal += $item['price'] * $item['quantity'];
            }
            return view('user.checkout', compact('cartItems', 'grandTotal'));
        } else {
            return redirect()->route('user.login')->with('error', 'Please log in as a customer to proceed to checkout.');            
        }
    }

    public function userLogin()
    {
        return view('user.user-login');
    }

    public function userRegister()
    {
        return view('user.user-signup');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
