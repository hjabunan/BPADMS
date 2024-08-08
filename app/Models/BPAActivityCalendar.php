<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAActivityCalendar extends Model
{
    use HasFactory;

    protected $table = "bpa_activitycalendars";
    // protected $fillable = ['act_name', 'act_startdate', 'act_enddate'];

    public function assigned_to(){
        return $this->belongsTo(User::class, 'act_assignedto');
    }

    public function created_by(){
        return $this->belongsTo(User::class, 'act_createdby');
    }

    public function questionnaire(){
        return $this->belongsTo(BPAQuestionnaire::class, 'act_questionnaire');
    }

}
