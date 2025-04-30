<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPAUsers extends Model
{
    use HasFactory;

    protected $table = "bpa_users";

    protected $fillable = ['id','name','email','idnum','password','role','access','first_time','validity_date','status','is_deleted','color_code','key'];
}
