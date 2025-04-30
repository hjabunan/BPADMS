<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPASurvey extends Model
{
    use HasFactory;

    protected $table = 'bpa_surveys';

    protected $fillable = ['id','qnr_id','qtn_id','survey_score','survey_remarks'];
}
