<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seeder classes create model instances using factory classes corresponing models
        //They facilitate mass-creating models
        //Clasele Seeder creaza instante utilizand clasele factory ale modelelor 
        //Ele faciliteaza crearea in masa a modelelor
        Product::factory(10)->create();
    }
}
