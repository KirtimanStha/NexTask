<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() : View
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create() : View
    {
        return view('products.form');
    }

    public function store(ProductRequest $request) : RedirectResponse
    {
        try{
            $input = $request->validated();

            $product = Product::create($input);
    
            return redirect(route('products.index'))->with('status', 'Product created successfully');
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong');
        }
    }

    public function edit(Product $product) : View
    {
        return view('products.form', compact('product'));
    }

    public function update(ProductRequest $request, Product $product) : RedirectResponse
    {
        try{
            $input = $request->validated();

            $product->update($input);
    
            return redirect(route('products.index'))->with('status', 'Product updated successfully');
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(Product $product) : string
    {
        $product->delete();

        return json_encode(['status' => 'success']);
    }
}
