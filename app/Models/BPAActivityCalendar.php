<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAActivityCalendar extends Model
{
    use HasFactory;

    protected $table = "bpa_activitycalendars";
    protected $fillable = ['act_name', 'act_startdate', 'act_enddate'];

}
