<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show(int $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(int $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
