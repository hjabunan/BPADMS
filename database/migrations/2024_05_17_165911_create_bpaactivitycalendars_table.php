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
        Schema::create('bpa_activitycalendars', function (Blueprint $table) {
            $table->id();
            $table->string('act_name');
            $table->string('act_location');
            $table->string('act_supervisor');
            $table->string('act_startdate');
            $table->string('act_enddate');
            $table->string('act_status'); // 0 - PENDING , 1 - ONGOING , 2 - DONE
            $table->bigInteger('act_assignedto');
            $table->bigInteger('act_createdby');
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpa_activitycalendars');
    }
};
