<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    //Trait PHP. foarte similar cu clasele abstracte, dar sunt defapt metode si propietati ce pot fi refolosite in declararea claselor
    use HasFactory;

    //Atributele ce pot fi folosite in operatiuni in masa (creere, update, atribuire)
    protected $fillable = [
        'name',
        "description"
    ];

    //Atributele ce pot fi convertite automat in alt tip de date
    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date"
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}