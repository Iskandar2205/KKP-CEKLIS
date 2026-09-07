<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('test_results', function (Blueprint $table) {


            $table->id();



            /*
            Relasi sesi pengujian
            */

            $table->foreignId('test_session_id')
                ->constrained()
                ->cascadeOnDelete();



            /*
            Data dasar pengujian
            */


            // jumlah panelis (n)
            $table->integer('jumlah_panelis')
                ->default(0);



            // jumlah parameter (6)
            $table->integer('jumlah_parameter')
                ->default(6);



            /*
            Perhitungan awal
            */


            // Σ seluruh nilai panelis
            $table->decimal(
                'total_nilai',
                10,
                5
            )
                ->default(0);



            // x bar
            $table->decimal(
                'rata_rata_produk',
                10,
                5
            )
                ->default(0);



            /*
            Statistik
            */


            // Z confidence 95%
            $table->decimal(
                'z_score',
                10,
                2
            )
                ->default(1.96);



            // akar jumlah panelis
            $table->decimal(
                'akar_n',
                10,
                5
            )
                ->default(0);



            // varians s²
            $table->decimal(
                'varians',
                10,
                8
            )
                ->default(0);



            // standar deviasi s
            $table->decimal(
                'standar_deviasi',
                10,
                8
            )
                ->default(0);



            // error statistik
            $table->decimal(
                'error',
                10,
                8
            )
                ->default(0);



            /*
            Interval mutu
            */


            $table->decimal(
                'p_min',
                10,
                8
            )
                ->default(0);



            $table->decimal(
                'p_max',
                10,
                8
            )
                ->default(0);




            /*
            Hasil akhir
            */


            // hasil pembulatan 0.5
            $table->decimal(
                'nilai_mutu',
                5,
                2
            )
                ->default(0);



            $table->string('kategori')
                ->nullable();



            $table->timestamps();
        });
    }




    public function down(): void
    {

        Schema::dropIfExists('test_results');
    }
};
