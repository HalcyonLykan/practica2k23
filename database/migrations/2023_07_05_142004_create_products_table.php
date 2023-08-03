<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        Migrations modify the database. Most commonly you will see these creating tables or updating their structure
        They can also delete tables or insert data
        */
        /*
        Migratiile modifica structura bazei de date. Cel mai des sunt folosite pentru a crea tabele sau a le improspata structura
        Migratiile pot de asemenea sa stearga tabele sau sa insereze date
        */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Migrations can also be reverted.
        //Down function definitions should contain the opposite of the up function definitions

        //Migratiile pot fi anulate 
        //Definitia functiei down ar trebui sa contina upusul definitiei functiei up
        Schema::dropIfExists('products');
    }
};
