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
        Schema::create('bpa_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('questionnaire_name');
            $table->string('form_id')->unique();
            $table->string('question_list');
            $table->tinyInteger('status')->default(1);
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_questionnaires');
    }
};
