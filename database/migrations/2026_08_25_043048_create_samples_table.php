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
        Schema::create('samples', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Relasi Produk
            |--------------------------------------------------------------------------
            |
            | Satu produk bisa memiliki banyak sample
            |
            */

            $table->foreignId('product_id')
                  ->constrained()
                  ->cascadeOnDelete();



            /*
            |--------------------------------------------------------------------------
            | Informasi Sample
            |--------------------------------------------------------------------------
            */

            $table->string('nomor_sample');

            $table->string('kode_sample');

            $table->date('tanggal');



            /*
            |--------------------------------------------------------------------------
            | Timestamp Laravel
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};