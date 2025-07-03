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
            $table->string('act_filename'); //will be use as the filename of the uploaded file
            $table->string('act_location');
            $table->string('act_supervisor');
            $table->bigInteger('act_servicevehicle');
            $table->bigInteger('act_toolbox');
            $table->bigInteger('act_techonsite');
            $table->bigInteger('act_revolvingfund');
            $table->string('act_startdate');
            $table->string('act_enddate');
            $table->string('act_status'); // 0 - PENDING , 1 - ONGOING , 2 - DONE

            $table->bigInteger('act_questionnaire');
            $table->bigInteger('act_assignedto');
            $table->bigInteger('act_createdby');
            // SURVEY
            $table->string('surv_GenOp')->default(0); 
            $table->string('surv_Doc')->default(0); 
            $table->string('surv_PartMgnt')->default(0); 
            $table->string('surv_Prsnl')->default(0); 
            $table->string('surv_5SPrac')->default(0); 
            // TOTAL RATE
            $table->string('surv_TotRate')->default(0); 
            // PERCENTAGE
            $table->string('percent_GenOp')->default(0);
            $table->string('percent_Doc')->default(0);
            $table->string('percent_PartMgnt')->default(0);
            $table->string('percent_Prsnl')->default(0);
            $table->string('percent_5SPrac')->default(0);
            // TOTAL PERCENTAGE
            $table->string('surv_TotPercent')->default(0);
            $table->string('surv_Remarks')->nullable(); 
            $table->bigInteger('is_closed')->default(0); 
            $table->bigInteger('is_deleted')->default(0); 
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
