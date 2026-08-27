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

        Schema::create('test_sessions', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | Relasi Sample
            |--------------------------------------------------------------------------
            |
            | Satu sample dapat memiliki beberapa sesi pengujian
            |
            */

            $table->foreignId('sample_id')
                  ->constrained()
                  ->cascadeOnDelete();




            /*
            |--------------------------------------------------------------------------
            | Informasi Pengujian
            |--------------------------------------------------------------------------
            */


            $table->date('tanggal_pengujian');



            /*
            |--------------------------------------------------------------------------
            | Status Pengujian
            |--------------------------------------------------------------------------
            |
            | draft    = persiapan admin
            | dibuka   = panelis dapat melakukan penilaian
            | selesai  = pengujian selesai
            |
            */


            $table->enum('status', [

                'draft',

                'dibuka',

                'selesai'

            ])
            ->default('draft');




            /*
            |--------------------------------------------------------------------------
            | Catatan Tambahan
            |--------------------------------------------------------------------------
            */


            $table->text('catatan')
                  ->nullable();




            $table->timestamps();


        });

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('test_sessions');

    }

};