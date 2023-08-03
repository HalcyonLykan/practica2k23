<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

//"Pivot" represents a row in a certain pivot table in the database. By convention the name for the table is the snake_case form of the class' name
//"Pivot" reprezinta un rand intro tabela pivot in baza de date. Prin conventie numele tabelei este forma in snake_case a numelui clasei 
class CategoryProduct extends Pivot
{

    protected $fillable = [
        "category_id",
        //By convention, we name foreign key rows, when they relate to other models as {model_name_in_snake_case}_id
        //Prin conventie, numim cheile straine, cand se refera la alte modele ca {nume_model_in_snake_case}_id
        "product_id"
    ];

    //A pivot row belongs to a single instance of both parent models
    //Un rand pivot apartine catei une singure instante ale modelelor parinte

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
