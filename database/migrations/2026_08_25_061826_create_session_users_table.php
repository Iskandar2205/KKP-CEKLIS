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
            | Relasi User
            |--------------------------------------------------------------------------
            */


            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();





            /*
            |--------------------------------------------------------------------------
            | Peran user dalam sesi
            |--------------------------------------------------------------------------
            |
            | panelis
            | penyelia
            | analis
            |
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