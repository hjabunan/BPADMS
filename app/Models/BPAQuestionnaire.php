<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAQuestionnaire extends Model
{
    use HasFactory;

    protected $table = 'bpa_questionnaires';
    
    public function formDetails() {
        return $this->belongsTo(BPAForms::class, 'id');
    }
    
    public function qtnDetails() {
        return $this->belongsTo(BPAQuestion::class, 'id');
    }
}
