<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
   use HasFactory;

    protected $fillable = [
        'name',
        "description",
        "price",
        "quantity"
    ];

    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date"
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    //Relationship: A Product has many Media
    //Relatie intre tabele: Un produs are mai multe Media
    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}