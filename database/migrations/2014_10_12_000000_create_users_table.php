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
        Schema::create('bpa_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('idnum');
            $table->string('password');
            $table->string('role'); // 0 = Super Admin , 1 = Admin , 2 = User
            $table->string('access')->nullable();
            $table->string('first_time')->default('1');
            $table->string('validity_date')->nullable();
            $table->tinyInteger('status'); // -1 = infinite , 0 = inactive , 1 = active with validity
            $table->string('color_code');
            $table->string('key');
            $table->bigInteger('is_deleted')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_users');
    }
};
