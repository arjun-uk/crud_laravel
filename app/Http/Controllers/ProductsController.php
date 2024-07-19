<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
         //dd($request->all());

        
        $product = products::find($request->id);
        //dd($product);
        $product->product_name = $request->name;
        $product->product_price = $request->price;
        $product->product_quantity = $request->quantity;
        $product->product_category = $request->category;
        if ($request->hasFile('image')) {
            $product->product_image = $request->image->store('products', 'public');
        }
        $product->save();

        return redirect()->route('home')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        products::truncate();
        return redirect()->route('home')->with('success', 'Products deleted successfully');
    }

    public function deleteProduct(Request $request, products $products)
    {
        $product = products::find($request->id);
        $product->delete();
    }

    public function editProductShow($id)
    {
        $product = products::find($id);
        return view('pages.edit_products', compact('product'));
        
    }
    public function deleteProductSHow($id)
    {
        $product = products::find($id);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->route('home')->with('success', 'Product deleted successfully');
    }
}
