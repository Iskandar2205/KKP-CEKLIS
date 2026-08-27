<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('users', function (Blueprint $table) {


            $table->enum('role', [

                'admin',

                'panelis',

                'pimpinan',

                'penyelia',

                'analis'

            ])
            ->default('panelis')
            ->change();


        });

    }



    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {


            $table->enum('role', [

                'admin',

                'panelis',

                'pimpinan'

            ])
            ->default('panelis')
            ->change();


        });

    }

};