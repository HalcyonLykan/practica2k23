<?php

namespace App\MiniServices;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

//Pentru cazurile cand mai multe controllere trebuie sa manipuleze o resursa e recomandat sa cream o clasa service.
//For cases when multiple controllers need to manipulate a resource, it's recomended to crea a service class. 
class MediaMiniService
{

    public static function create(File $file, Product $product, Request $request)
    {
        //With UUID version 4 it's virtually impossible to create duplicate Universally Unique IDentifiers. Still, we treated the case where we randomly got an UUID we already saved in DB
        //Folosing UUID versiunea 4 este practic imposibil sa cream UUID-uri duplicate. Totusi, am prevazut cazul in care am creat un UUID pe care l-am mai creat inainte. 
        do {
            $newFileName = Str::uuid();
        } while (Media::where("path", "like", "%" . $newFileName)->count() > 0);

        /* 
        Pentru usurinta am folosit metoda storeAs din clasa File pentru a prelua fisierul efectiv din request.
        Aceasta operatiune se poate face si prin fatada Storage.
        I-am schimbat numele intr-unul unic pentru a nu suprascrie fisiere
        */
        /* 
        For convenience we used the storeAs method in the File class to take the actual file from the request
        This can also be done with the Storage facade
        We changed the name so as to not override the images on disk
        */
        $path = $file->storeAs('public/media', $newFileName . "." . $file->getClientOriginalExtension());
        $media = new Media([
            "original_file_name" => $file->getClientOriginalName(),
            "path" => $path,
            "original_extension" => $file->getClientOriginalExtension(),
            "product_id" => $product->id
        ]);
        $media->save();
    }

    public static function destroy(Media $media)
    {
        //If we can delete the file from disk, that is, if there is something to delete, we delete the file and then the entry in the database
        //Daca exista un fisier pe disk pe care il putem sterge, il stergem si apoi stergem si randul din DB
        if (Storage::delete($media->path)) {
            //Folosim fatada Log pentru a scrie in larave.log
            //We use the Log facade to write in the laravel.log file
            \Log::debug("product " . $media->id . "deleted by " . Auth::user()->id);

            $media->delete();
            return back();
        }

        return back()->with("errors", "Couldn't delete");
    }

    public static function batchCreate(Product $product, Request $request): void
    {
        //This function simply iterates over multiple files 
        //Functia itereaza peste mai multe fisiere
        foreach ($request->productImages as $file) {
            self::create($file, $product, $request);
        }
    }
}