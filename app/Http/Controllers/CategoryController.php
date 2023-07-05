<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index () {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    public function edit ($id) {
        $category = Category::where("id",$id)->first();
        return view('categories.edit', ['category' => $category]);
    }

    public function update ($id, Request $request) {
        $category = Category::where("id",$id)->first();

        $category->name = $request->get('name');
        $category->description = $request->get('description');

        $category->save();

        return redirect(route("categories.edit", ["id" => $id]));
    }

    public function create () {
        return view('categories.create');
    }

    public function save (Request $request) {
        $category = new Category();

        $category->name = $request->get('name');
        $category->description = $request->get('description');

        $category->save();

        return redirect(route("categories.index"));
    }

    public function delete ($id) {
        $category = Category::where("id",$id)->first();
        $category->delete();
        return redirect(route("categories.index"));

    }
}