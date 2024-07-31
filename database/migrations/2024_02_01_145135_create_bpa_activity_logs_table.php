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
        Schema::create('bpa_activitylogs', function (Blueprint $table) {
            $table->id();
            $table->string('table');
            $table->string('table_key');
            $table->string('action'); // SET, EDIT, DELETE
            $table->string('description');
            $table->string('field')->nullable();
            $table->string('before')->nullable();
            $table->string('after')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('ipaddress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_activitylogs');
    }
};
