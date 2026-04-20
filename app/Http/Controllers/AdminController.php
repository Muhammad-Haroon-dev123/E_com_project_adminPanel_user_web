<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function header() {}

    public function index_counter()
    {
        $categories = Category::all();
        $products = admin::all();
        
        // Best Sellers: Random products (you can change logic later)
        $bestSellers = admin::inRandomOrder()->take(4)->get();
        
        // New Arrivals: Latest products
        $newArrivals = admin::orderBy('created_at', 'desc')->take(4)->get();
        
        // Hot Sales: Another set of random products (you can add discount logic later)
        $hotSales = admin::inRandomOrder()->take(4)->get();
        
        return view('user.index', compact('products', 'categories', 'bestSellers', 'newArrivals', 'hotSales'));
    }

    public function index()
    {
        return view('admin.app');
    }

    public function addproduct()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function allproduct()
    {
        $products = admin::all();
        return view('admin.all_product', compact('products'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        // Create Product
        $product = Admin::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_image' => $imagePath,
        ]);

        // Attach multiple categories
        $product->categories()->attach($request->category_id);
        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        session(['previous_url' => url()->previous()]);
        $categories = Category::all();
        $product = admin::findOrFail($id);
        return view('admin.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Admin::findOrFail($id);

        // validation
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // image update
        if ($request->hasFile('product_image')) {

            // delete old image
            if ($product->product_image && file_exists(storage_path('app/public/'.$product->product_image))) {
                unlink(storage_path('app/public/'.$product->product_image));
            }

            // store new image
            $imagePath = $request->file('product_image')->store('products', 'public');
            $product->product_image = $imagePath;
        }

        // update fields
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;

        $product->save();

        // ✅ IMPORTANT — Update categories
        $product->categories()->sync($request->category_id);

        return redirect(session('previous_url'))
            ->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = admin::findOrFail($id);

        // image delete
        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }

        // DB record delete
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
