<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Listare resursa R
     */
    public function index(Request $request)
    {
        $products = Product::query();
        $where = [];

        if ($request->has("search") && $search = $request->get("search")) {
            $where[]= ["name", "like", "%" . $search . "%"];
        }

        $products->where($where);
        $products = $products->paginate(15);
        
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
    public function store(CreateProductRequest $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

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
    public function update(UpdateProductRequest $request, Product $product)
    {


        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

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