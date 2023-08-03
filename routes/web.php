<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\MediaController;
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
    return redirect(route('categories.index'));
});

//Legacy redirect
//Redirect mai vechi
Route::get('/dashboard', function () {
    return redirect(route('categories.index'));
    /*
    This route has middleware applied through the use of `middleware(...)`. 
    There are a small number of middleware predefined in Kernel.php (https://laravel.com/docs/10.x/middleware#global-middleware) 
    'auth' checks if the reqeuest contains an authenticated user
    'verified' checks if the user has a verified email address. We didn't bother verifying users. 
    */

    /* 
    Ruta contine verificari de tip middleware declarate prin `middleware(...)`. 
    Exista un numar mic de middleware predefinit in Kernel.php (https://laravel.com/docs/10.x/middleware#global-middleware) 
    'auth' verifica daca requestul are un utilizator autentificat
    'verified' verifica daca utilizatorul are email-ul verificat. Nu am verificat utilizatorii
    */
})->middleware(['auth' /*, 'verified'*/])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Profile routes were not discussed
    //Rutele de profil nu au fost discutate
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //"name" assigns a name to the route. We use it so we can write shorter code with the "route(...)" helper
    //"name" atribuie un nume rutei. Il folosim ca sa scriem mai putin cod cand apelam helperul "route(...)"
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    /* 
    Metodele pe fatada Route sunt corespondente verbelor HTTP (GET, POST, PUT, PATCH, DELETE). 
    Ne putem rezuma la a folosi GET si POST dar e best practice sa le folosim pe toate in functie de caz 
    */
    /* 
    The methods in the Route facade are correspondent to HTTP verbs (GET, POST, PUT, PATCH, DELETE). 
    We can restrict to only using GET and POST but it's best practice to use all of them depending on what we're trying to do
    */
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get("/categories",[CategoryController::class, "index"])->name("categories.index");
    // Route::post("/categories",[CategoryController::class, "store"])->name('categories.store');
    // Route::get("/categories/create",[CategoryController::class, "create"])->name('categories.create');
    // Route::get("/categories/{category}",[CategoryController::class, "show"])->name("categories.show");
    // Route::get("/categories/{category}",[CategoryController::class, "edit"])->name('categories.edit');
    // Route::post("/categories/{category}/edit",[CategoryController::class, "update"])->name('categories.update');
    // Route::delete("/categories/{category}",[CategoryController::class, "destroy"])->name('categories.destroy');

    //Route::resource(...) creates all of the routes commented above. You can check by running `php artisan route:list`
    //Route::resource(...) creaza toate rutele comentate mai sus. Se paote verifica ruland `php artisan route:list`
    Route::resource("categories", CategoryController::class)->except("index");
    //except(...) limits the routes "resource(...)" registers to every route except those routes
    //except(...) limiteaza rutele inregistrate de catre "resource(...)" la TOATE RUTELE CU EXCEPTIA rutelor cerute
    Route::resource("products", ProductController::class)->except("index");

    //Route for linking categories to products
    //Ruta pentru legarea categoriilor de produse
    Route::post("/categoryproduct/{category}/{product}", [CategoryProductController::class, "store"])->name('categoryproduct.store');
    //Route for unlinking categories from products
    //Ruta pentru dezlegarea categoriilor de produse 
    Route::delete("/categoryproduct/{category}/{product}", [CategoryProductController::class, "destroy"])->name('categoryproduct.destroy');

    //Route for deleting Media
    //Ruta pentru stergere Media
    Route::delete("/media/{media}", [MediaController::class, "destroy"])->name('media.destroy');
});

//only(...) limits the routes "resource(...)" registers to only those routes
//only(...) limiteaza rutele inregistrate de catre "resource(...)" la DOAR rutele cerute
Route::resource("categories", CategoryController::class)->only("index");
Route::resource("products", ProductController::class)->only("index");


require __DIR__ . '/auth.php';