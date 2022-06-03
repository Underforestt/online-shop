<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category');
        $products = $categoryId
            ? Category::findOrFail($categoryId)->products
            : Product::all();
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->only(['name', 'description', 'amount', 'price']));
        if ($request->has('category_id')) {
            $product->category()->attach($request->category_id);
        }
        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->only(['name', 'description', 'amount', 'price']));
        if ($request->has('category_id')) {
            $product->category()->sync($request->category_id);
        }
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
