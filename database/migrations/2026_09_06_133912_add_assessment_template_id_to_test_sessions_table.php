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
        Schema::table('test_sessions', function (Blueprint $table) {

           $table->foreignId('assessment_template_id')
            ->nullable()
            ->after('sample_id')
             ->constrained('assessment_templates')
             ->cascadeOnDelete();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_sessions', function (Blueprint $table) {

            $table->dropForeign([
                'assessment_template_id'
            ]);

            $table->dropColumn(
                'assessment_template_id'
            );

        });
    }
};