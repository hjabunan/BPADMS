<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAQuestion extends Model
{
    use HasFactory;

    protected $table = "bpa_questions";

    public function processDetails() {
        return $this->belongsTo(BPAProcess::class, 'process_id');
    }

    public function cpointDetails() {
        return $this->belongsTo(BPACpoint::class, 'cpoint_id');
    }
}
