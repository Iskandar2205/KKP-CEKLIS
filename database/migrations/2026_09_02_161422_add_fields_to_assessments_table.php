<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('assessments', function (Blueprint $table) {

            $table->foreignId('test_session_id')
                ->after('id')
                ->constrained()
                ->cascadeOnDelete();


            $table->foreignId('user_id')
                ->after('test_session_id')
                ->constrained('users')
                ->cascadeOnDelete();


            $table->integer('total_nilai')
                ->nullable();


            $table->decimal('nilai_akhir',5,2)
                ->nullable();


            $table->string('status')
                ->default('draft');

        });

    }



    public function down(): void
    {

        Schema::table('assessments', function (Blueprint $table) {

            $table->dropForeign([
                'test_session_id'
            ]);

            $table->dropForeign([
                'user_id'
            ]);


            $table->dropColumn([

                'test_session_id',
                'user_id',
                'total_nilai',
                'nilai_akhir',
                'status'

            ]);

        });

    }

};