<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Listare resursa R
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Formular pentru creare resursa noua C
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Salvare resursa noua C
     */
    public function store(Request $request)
    {
        $valid = $request->validate(
            [
                "name" => "string|min:1|max:255",
                "description" => "string|min:1|max:255",
                "price" => "numeric|min:1|max:999",
                "quantity" => "numeric|min:1|max:999"
            ]
        );

        $product = new Product();

        $product->name = $valid["name"];
        $product->description = $valid["description"];
        $product->price = $valid["price"];
        $product->quantity = $valid["quantity"];

        $product->save();

        return redirect(route("products.index"));
    }

    /**
     * Aratare resursa R
     */
    public function show(Product $product)
    {
        // deocamdata nu are sens sa creem o metoda separata pentru a arata o categorie deocamdata
        return redirect(route("products.edit", ["product" => $product->id]));
    }

    /**
     * Formular pentru editare resursa existenta R
     */
    public function edit(Product $product)
    {
        $categories = Category::whereDoesntHave('products', function (Builder $query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return view('products.edit', ['product' => $product, 'attachedCategories' => $product->categories, "nonAttachedCategories" => $categories]);
    }

    /**
     * Salvare resursa existenta U
     */
    public function update(Request $request, Product $product)
    {
        $valid = $request->validate(
            [
                "name" => "string|min:1|max:255",
                "description" => "string|min:1|max:255",
                "price" => "numeric|min:1|max:999",
                "quantity" => "numeric|min:1|max:999"
            ]
        );

        $product->name = $valid["name"];
        $product->description = $valid["description"];
        $product->price = $valid["price"];
        $product->quantity = $valid["quantity"];

        $product->save();

        return redirect(route("products.edit", ["product" => $product->id]));
    }

    /**
     * Stergere resursa D
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route("products.index"));
    }
}