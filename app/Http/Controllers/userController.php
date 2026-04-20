<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        // Best Sellers: Random products (you can change logic later)
        $bestSellers = Admin::inRandomOrder()->take(4)->get();
        
        // New Arrivals: Latest products
        $newArrivals = Admin::orderBy('created_at', 'desc')->take(4)->get();
        
        // Hot Sales: Another set of random products (you can add discount logic later)
        $hotSales = Admin::inRandomOrder()->take(4)->get();
        
        return view('user.index', compact('categories', 'bestSellers', 'newArrivals', 'hotSales'));
    }

        public function showProducts($slug = null)
    {
        $allproducts = Admin::all();
        $categories = Category::all();
        $category = $slug ? Category::where('slug', $slug)->firstOrFail() : null;
        $products = $category ? $category->products()->latest()->get() : Admin::latest()->get();
        return view('user.product', compact('products', 'category', 'categories', 'allproducts'));
    }

    public function show($id)
    {
        $product = Admin::findOrFail($id);
        return view('user.single', compact('product'));
    }

    public function addToCard($id)
    {
        $product = Admin::findOrFail($id);
        return view('user.add-to-card', compact('product'));
    }

    public function shoppingCart(){
        return view('user.shopping-cart');
    }
    
}
