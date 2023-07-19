<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     */
    public function store( string $category, string $product)
    {
        if (CategoryProduct::where([["category_id", $category], ["product_id", $product]])->count() == 0) {
            $categoryPoduct = new CategoryProduct(["category_id" => $category, "product_id" => $product]);
            $categoryPoduct->save();
        }
        return redirect(route("categories.edit", ["category" => $category]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $category, string $product)
    {
        CategoryProduct::where([["category_id", $category], ["product_id", $product]])->delete();
        return redirect(route("categories.edit", ["category" => $category]));
    }
}
