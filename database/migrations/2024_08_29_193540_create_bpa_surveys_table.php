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
        Schema::create('bpa_surveys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('act_id');
            $table->bigInteger('qnr_id');
            $table->bigInteger('qtn_id');
            $table->float('survey_score');
            $table->string('survey_remarks')->nullable();
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_surveys');
    }
};
