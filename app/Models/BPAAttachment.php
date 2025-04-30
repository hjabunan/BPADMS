<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAAttachment extends Model
{
    use HasFactory;

    protected $table = 'bpa_attachments';

    protected $fillable = ['id','qnr_id','qtn_id','uploader','filename','key'];
}
