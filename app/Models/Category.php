<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//"Model" represents a row in a certain table in the database. By convention the name for the table is the plural form of the class' name
//"Model" reprezinta un rand intro tabela in baza de date. Prin conventie numele tabelei este forma de plural a numelui clasei 
class Category extends Model
{
    //Trait PHP. foarte similar cu clasele abstracte, dar sunt defapt metode si propietati ce pot fi refolosite in declararea claselor
    //HasFactory: Exista o clasa denumita prin conventie {numele clasei ce primeste traitul}Factory care genereaza instante ale aceste clase
    use HasFactory;

    //Class properties which can be mass-assigned (during create, update)
    //Atributele ce pot fi folosite in operatiuni in masa (creere, update)
    protected $fillable = [
        'name',
        "description"
    ];

    //Class properties which need to be cast right after instantiation and before insertion in DB
    //Atributele ce trebuie convertite in alt tip dupa instantiere si inainte de insertie in DB
    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date"
    ];

    //Table Relationship: A category belongs to multiple products
    //Relatie intre tabele: O categorie apartine la mai multe produse
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}