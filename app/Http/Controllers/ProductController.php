<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\MiniServices\MediaMiniService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
    public function index(Request $request)
    {
        //Usually an index function provides a listing of the resource but that is not a rule
        //We chose to have this function paginate fifteen rows and allow search and filtering

        //De obicei, o functie index rezulta intr-o listare de resurse dar asta nu este o regula
        //Am ales ca functia noastra sa pagineze 15 rezultate cu posibilitatea de cautare si filtrare

        //We start writing a database query
        //Pornim scrierea unui query in baza de date
        $products = Product::query();

        /* 
        We group where clauses so they can all be applied at once. If we were to chain them by where(...)->where(...) they would have been treated as OR conditions
        Grupam clauzele where pentru a le putea aplica pe toate deodata. Daca le inlantiuiam prin where(...)->where(...) ar fi fost aplicate individual
        */
        
        /*
        where(...)->where(...) => WHERE ... OR WHERE ...
        where([[...], [...], [...]]) =>  WHERE ... AND WHERE ... AND WHERE ...
        */
        $where = [];

        //Search by name
        //Cautare dupa nume
        if ($request->has('search') && $request->get('search')) {
            $where[] = ['name', 'like', "%" . $request->get('search') . "%"];
        }

        // Filter by price: greater than and lower than conditions. This could have been done with a whereBetween; The same goes for quantity
        // Filtrare dupa pret: prin conditii de mai mare ca si mai mic decat. Se putea folosi functia whereBetween; Si aici si pentru cantitate
        if ($request->has('productPriceGreaterThanFilter') && $request->get('productPriceGreaterThanFilter')) {
            $where[] = ['price', '>', $request->get('productPriceGreaterThanFilter')];
        }

        if ($request->has('productPriceLowerThanFilter') && $request->get('productPriceLowerThanFilter')) {
            $where[] = ['price', '<', $request->get('productPriceLowerThanFilter')];
        }

        if ($request->has('productQuantityGreaterThanFilter') && $request->get('productQuantityGreaterThanFilter')) {
            $where[] = ['quantity', '>', $request->get('productQuantityGreaterThanFilter')];
        }

        if ($request->has('productQuantityLowerThanFilter') && $request->get('productQuantityLowerThanFilter')) {
            $where[] = ['quantity', '<', $request->get('productQuantityLowerThanFilter')];
        }

        //If we managed to find filters or search in request we apply them
        //Daca am gasit cautare sau filtrare in request, le aplicam
        if (count($where))
            $products->where($where);

        //For ordering we have orderBy which accepts a column name and a direction
        //Pentru ordonare avem metoda orderBy care preia un nume de coloana si o directie de ordonare
        if (
            ($request->has('orderBy') && $request->get('orderBy'))
            && ($request->has('orderByDirection') && $request->get('orderByDirection'))
        ) {
            $products->orderBy($request->get('orderBy'), $request->get('orderByDirection'));
        }

        //For pagination we have a method called "paginate" which adds an OFFSET in query
        //Pentru paginare avem metoda "paginate" care adauga o clauza OFFSET in query
        $products = $products->paginate(15);

        //So as to not lose our filter query string, we collect every parameter and append it to our pagination links
        //This could also be done with the following methods, but they execute the for loop written below
        // $products->appends($request->all());
        // $products->withQueryString();
        //Pentru a nu pierde query string-ul de filtrare, colectam fiecare parametru din request si il adaugam la link-urile de paginare
        //Acest proces se poate realiza folosind metodele de mai sus dar acestea executa for-ul de mai jos
        foreach ($request->collect() as $key => $param) {
            if ($key != "page")
                $products->appends($key, $param);
        }

        return view('products.index', ['products' => $products]);
    }

    /**
     * Formular pentru creare resursa noua C
     */
    public function create()
    {
        //View is a helper which takes a blade.php file and compiles the code inside it into phtml and then html. After it prepares the html this is returned by the controller to the browser
        //View este un helper care ia un fisier blade.php file si transforma codul dinauntru in phtml si apo in html. Dupa ce este preparat, html-ul este intros inapoi browserului de catre controller
        return view('products.create');
    }

    /**
     * Salvare resursa noua C
     */
    public function store(CreateProductRequest $request)
    {
        //We instantiate a new Product
        //Instantiem clasa Product
        $product = new Product();

        //We take the data required for our product from the request
        //Preluam datele necesare creeri produsului din request
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        //Inseram produsul in baza de date
        //We save the product in the database
        $product->save();

        //If there are images attached to the request we call the media service to save them
        //Daca exista imagini atasate de request, apelam serviciul de media pentru a le salva
        if ($request->has("productImages")) {
            MediaMiniService::batchCreate($product, $request);
        }

        //We answer by redirecting the user back to the index route to make them leave the create page
        //Raspundem cu un redirect la ruta de index pentru a parasii pagina creeri resurse
        return redirect(route("products.index"));
    }

    /**
     * Aratare resursa R
     */
    public function show(Product $product)
    {

        //We load the media relationship to have the images available wehn rendering the blade
        //We can load the media as we're rendering the blad but that's bad practice
        //This is called eager loading
        //Folosim functia load pentru a incarca relatia media, astfel incat sa avem imaginile disponibile cand se compileaza blade-ul
        //Putem incarca si in timpul compilari bladeului dar e recomandat sa incarcam toate informatiile inainte
        //Asta se numeste eager-loading
        $product->load("media");

        //The view helper can take an array with named keys to pass towards the blade
        //Helperul view preia ca parametru optional un vector cu chei de tip string (HashMap, Dictionary) care sunt apoi disponibile in blade
        return view('products.show', ['product' => $product, 'attachedCategories' => $product->categories]);
    }

    /**
     * Formular pentru editare resursa existenta R
     */
    public function edit(Product $product)
    {
        //It's possible to query releationship existence or absence through whereHas and whereDoesntHave methods
        //Este posibil sa interogam existenta sau absenta relatiilor prin functiile whereHas si WhereDoesntHave
        $categories = Category::whereDoesntHave('products', function (Builder $query) use ($product) {
            //the second parameter of whereDoesntHave is a function, in this case anonymous, which can restrict selection of related models
            //al doilea parametru al functiei whereDoesntHave este o functie, in acest caz anonima, care poate restrictiona ce modele pot fi selectate pe relatie 
            $query->where('product_id', $product->id);
        })->get();

        $product->load("media");

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

        if ($request->has("productImages")) {
            MediaMiniService::batchCreate($product, $request);
        }

        return redirect(route("products.edit", ["product" => $product->id]));
    }

    /**
     * Stergere resursa D
     */
    public function destroy(Product $product)
    {
        \Log::debug("product " . $product->id . "deleted by " . Auth::user()->id);
        $product->delete();
        return redirect(route("products.index"));
    }
}