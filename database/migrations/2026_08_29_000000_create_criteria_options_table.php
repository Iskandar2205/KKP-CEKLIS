<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {


        Schema::create('criteria_options', function (Blueprint $table) {


            $table->id();


            $table->foreignId('criteria_id')
                ->constrained('criteria')
                ->cascadeOnDelete();



            $table->integer('nilai');


            $table->text('deskripsi');


            $table->timestamps();


        });


    }



    public function down(): void
    {


        Schema::dropIfExists('criteria_options');


    }

};