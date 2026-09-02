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
        Schema::table('criteria', function (Blueprint $table) {
            
        $table->foreignId('assessment_section_id')
            ->after('id')
            ->constrained()
            ->cascadeOnDelete();


        $table->integer('urutan')
            ->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('criteria', function (Blueprint $table) {

            $table->dropForeign([
                'assessment_section_id'
            ]);

            $table->dropColumn([
                'assessment_section_id',
                'urutan'
            ]);

        });

    }

};
