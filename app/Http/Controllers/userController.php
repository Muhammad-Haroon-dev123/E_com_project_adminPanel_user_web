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
        return view('user.index', compact('categories'));
    }

    
        public function showProducts($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();
        return view('user.product', compact('products', 'category', 'categories'));
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
