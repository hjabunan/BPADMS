<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPACpoint extends Model
{
    use HasFactory;

    protected $table = "bpa_cpoints";

    public function processDetails() {
        return $this->belongsTo(BPAProcess::class, 'process_id');
    }
}
