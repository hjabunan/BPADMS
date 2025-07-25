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
        Schema::create('bpa_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('rating_name');
            $table->string('rating_description');
            $table->string('rating_gradefrom');
            $table->string('rating_gradeto');
            $table->tinyInteger('rating_remarks'); // 0 = Failed, 1 = Passed
            $table->string('rating_colorcode')->nullable();
            $table->tinyInteger('rating_status')->default(1); // 0 = inactive, 1 = active
            $table->tinyInteger('is_deleted')->default(0); // 0 = not deleted, 1 = deleted
            $table->string('key')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_ratings');
    }
};
