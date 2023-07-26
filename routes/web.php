<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('categories.index'));
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    return redirect(route('categories.index'));
})/*->middleware(['auth', 'verified'])*/->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get("/categories",[CategoryController::class, "index"])->name("categories.index");
// Route::post("/categories",[CategoryController::class, "store"])->name('categories.store');
// Route::get("/categories/create",[CategoryController::class, "create"])->name('categories.create');
// Route::get("/categories/{category}",[CategoryController::class, "show"])->name("categories.show");
// Route::get("/categories/{category}",[CategoryController::class, "edit"])->name('categories.edit');
// Route::post("/categories/{category}/edit",[CategoryController::class, "update"])->name('categories.update');
// Route::delete("/categories/{category}",[CategoryController::class, "destroy"])->name('categories.destroy');

// Pentru resurse CRUD putem scurta declararea ruterlor folosind metoda "resource". Creaza celeasi rute cu aceleasi nume ca si cele comentate mai sus
Route::middleware('auth')->group(function () {
    Route::resource("categories", CategoryController::class)->only("store", "create", "edit", "update", "destroy");
    Route::resource("products", ProductController::class)->only("store", "create", "edit", "update", "destroy");
});

Route::resource("categories", CategoryController::class)->except("store", "create", "edit", "update", "destroy");
Route::resource("products", ProductController::class)->except("store", "create", "edit", "update", "destroy");

Route::post("/categoryproduct/{category}/{product}", [CategoryProductController::class, "store"])->name('categoryproduct.store');
Route::delete("/categoryproduct/{category}/{product}", [CategoryProductController::class, "destroy"])->name('categoryproduct.destroy');

require __DIR__.'/auth.php';
