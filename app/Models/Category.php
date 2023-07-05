<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Category extends Model
{
    //Trait PHP. foarte similar cu clasele abstracte, dar sunt defapt metode si propietati ce pot fi refolosite in declararea claselor
    use HasFactory; 

    //Atributele ce pot fi folosite in operatiuni in masa (creere, update, atribuire)
    protected $fillable = [
        'name',
        "description"
    ];

    //Atributele ce pot fi folosite in operatiuni in masa (creere, update, atribuire)
    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date"
    ];
}