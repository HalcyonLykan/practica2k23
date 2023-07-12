<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare
        $valid = $request->validate(
            [
                "name" => "string|min:1|max:255",
                "description" => "string|min:1|max:255",
                "price" => "numeric|min:1|max:999",
                "quantity" => "numeric|min:1|max:999"

            ]
        );

        $product = new Product();
        $product->name = $valid['name'];
        $product->description = $valid["description"];
        $product->price = $valid["price"];
        $product->quantity = $valid["quantity"];

        $product->save();

        return redirect(route("products.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect(route("products.index"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::whereDoesntHave('products', function (Builder $query) use ($product) {
            $query->where('id', $product->id);
        })->get();

        return view("products.edit", ["product" => $product, "attachedCategories" => $product->categories, "nonAttachedCategories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->description = $request->get('price');
        $product->description = $request->get('quantity');

        $product->save();

        return redirect(route("products.edit", ["product" => $product->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route("products.index"));
    }
}