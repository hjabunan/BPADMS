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
        Schema::create('bpa_login_logs', function (Blueprint $table) {
            $table->id();
            $table->string('login_username');
            $table->string('login_time');
            $table->string('login_ipaddress');
            $table->string('login_eventtype');
            $table->string('login_status');
            $table->string('failure_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_login_logs');
    }
};
