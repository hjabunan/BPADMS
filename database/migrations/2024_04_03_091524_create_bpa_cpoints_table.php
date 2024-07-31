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
        Schema::create('bpa_cpoints', function (Blueprint $table) {
            $table->id();
            $table->string('cpoint_name');
            $table->string('process_id');
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
        Schema::dropIfExists('bpa_cpoints');
    }
};
