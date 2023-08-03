<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{

    //We will use this to represent images but it's extensible enough to use for any file
    //Vom folosi aceasta clasa pentru a reprezenta si manipula imagini, dar este extensibila si poate fi folosita pentru orice fisier
    
    protected $fillable = [
        'original_file_name',
        "path",
        "original_extension",
        "product_id"
    ];

    protected $casts = [
        "created_at" => "date",
        "updated_at" => "date"
    ];

    //Table Relationship: A Media belongs to a single products
    //Relatie intre tabele: Un rand Media apartine la unui singur produs
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}