<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('session_users', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | Relasi Test Session
            |--------------------------------------------------------------------------
            */

            $table->foreignId('test_session_id')
                  ->constrained()
                  ->cascadeOnDelete();





            /*
            |--------------------------------------------------------------------------
            | Nama User Dalam Pengujian
            |--------------------------------------------------------------------------
            |
            | Panelis manual masuk ke sini
            | Contoh:
            | Ahmad
            | Budi
            |
            */

            $table->string('nama');





            /*
            |--------------------------------------------------------------------------
            | Relasi User (Opsional)
            |--------------------------------------------------------------------------
            |
            | Dipakai untuk penyelia
            | Panelis manual = null
            |
            */

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();







            /*
            |--------------------------------------------------------------------------
            | Peran dalam sesi
            |--------------------------------------------------------------------------
            */

            $table->enum('role',[

                'panelis',

                'penyelia',

                'analis'

            ]);



            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('session_users');

    }

};