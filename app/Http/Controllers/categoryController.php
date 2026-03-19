<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    // Show all categories + form
    public function index()
    {
        $categories = Category::all();

        return view('admin.add-show-category', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);
        $image = null;

        if ($request->hasFile('image')) {
             $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            $image = $request->file('image')->store('categories', 'public');
        }


        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $image,
        ]);

        return redirect()->route('add_show_category')->with('success', 'Category added successfully!');
    }

    // Edit category (fill form)
    public function edit($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);

        return view('admin.add-show-category', compact('categories', 'category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'slug' => 'required|unique:categories,slug,'.$id,
        ]);

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $request->file('image')->store('categories', 'public');
            
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $image
        ]);

        return redirect()->route('add_show_category')->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('add_show_category')->with('success', 'Category deleted successfully!');
    }

    public function showProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();
        return view('admin.category_products', compact('products', 'category'));
    }

    public function removeProduct($categoryId, $productId)
    {
        $product = Admin::findOrFail($productId);

        $product->categories()->detach($categoryId);

        return back()->with('success', 'Product removed from this category only');
    }
}
