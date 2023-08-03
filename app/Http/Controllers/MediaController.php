<?php

namespace App\Http\Controllers;

use App\MiniServices\MediaMiniService;
use App\Models\Media;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        //We extracted this in a service class so that we can delete all images when we delete products
        //Am extras aceasta functionalitate intr-o clasa service pentru a putea sterge imaginile cand stergem un produs
        return MediaMiniService::destroy($media);
    }
}