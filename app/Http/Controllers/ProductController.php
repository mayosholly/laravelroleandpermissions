<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Product::class);
        return inertia('Admin/Product/ProductIndex', [
            'products' => Product::all()
        ]);
    }
    public function create(){
        $this->authorize('create', Product::class);
        return inertia('Admin/Product/ProductCreate');
    }

    public function store(CreateProductRequest $request){
        $this->authorize('create', Product::class);
        $product = Product::create([
            'name' => $request->name
        ]);
        return to_route('products.index');
    }

    public function edit(Product $product){
        $this->authorize('update', $product);
        return inertia('Admin/Product/ProductEdit', [
            'product' => $product
        ]);
    }

    public function update(CreateProductRequest $request, Product $product){
        $this->authorize('update', $product);
        $product->update([
            'name' => $request->name
        ]);
        return to_route('products.index');
    }

    public function destroy(Product $product){
        $this->authorize('delete', $product);
        $product->delete();
        return to_route('products.index');

    }

}
