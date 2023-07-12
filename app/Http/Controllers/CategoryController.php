<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

   /**
    * C - Create
    * R - Read
    * U - Update
    * D - Delete
    */
    
    /**
     * Listare resursa R
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Formular pentru creare resursa noua C
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Salvare resursa noua C
     */
    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->get('name');
        $category->description = $request->get('description');

        $category->save();

        return redirect(route("categories.index"));
    }

    /**
     * Aratare resursa R
     */
    public function show(Category $category)
    {
        // deocamdata nu are sens sa creem o metoda separata pentru a arata o categorie deocamdata
        return redirect(route("categories.edit", ["category" => $category->id]));
    }

    /**
     * Formular pentru editare resursa existenta R
     */
    public function edit(Category $category)
    {
        $nonAttachedProducts = Product::whereDoesntHave('categories', function (\Illuminate\Database\Eloquent\Builder $query) use($category) {
            $query->where('category_id', $category->id);
        })->get();
        return view('categories.edit', ['category' => $category, 'attachedProducts' => $category->products, "nonAttachedProducts"=> $nonAttachedProducts]);
    }

    /**
     * Salvare resursa existenta U
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->description = $request->get('description');

        $category->save();

        return redirect(route("categories.edit", ["category" =>  $category->id]));
    }

    /**
     * Stergere resursa D
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route("categories.index"));
    }
}
