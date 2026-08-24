<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    /**
     * Membuat tabel products
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            // Primary Key
            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Informasi Produk
            |--------------------------------------------------------------------------
            */

            $table->string('nama_produk');

            $table->string('jenis_produk');


            /*
            |--------------------------------------------------------------------------
            | Timestamp Laravel
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }


    /**
     * Menghapus tabel products jika rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }

};