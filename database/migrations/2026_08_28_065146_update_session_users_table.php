<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('session_users', function (Blueprint $table) {


            // User id dibuat optional
            $table->foreignId('user_id')
                  ->nullable()
                  ->change();


        });

    }



    public function down(): void
    {

        Schema::table('session_users', function (Blueprint $table) {


            $table->foreignId('user_id')
                  ->nullable(false)
                  ->change();


        });

    }

};