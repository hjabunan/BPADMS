<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAForms extends Model
{
    use HasFactory;

    protected $table = "bpa_forms";

    public function qnrDetails() {
        return $this->belongsTo(BPAQuestionnaire::class, 'form_id');
    }
}
