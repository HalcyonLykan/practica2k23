<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
      /**
    * C - Create
    * R - Read
    * U - Update
    * D - Delete
    */

    /**
     * Salvare resursa noua C
     */
    public function store(Request $request, string $category, string $product)
    {
        if (CategoryProduct::where([['category_id', $category], ['product_id', $product]])->count() == 0)
        {
            $categoryProduct = new CategoryProduct(['category_id' => $category, 'product_id' => $product]);
            $categoryProduct->save();
        }
        return redirect(route('categories.edit', ['category' => $category]));
    }


    /**
     * Stergere resursa D
     */
    public function destroy(Request $request, string $category, string $product)
    {
        CategoryProduct::where([["category_id", $category], ["product_id", $product]])->delete();
        return redirect(route('categories.edit', ['category' => $category]));
    }
}

