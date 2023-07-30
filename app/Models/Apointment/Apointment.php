<?php

namespace App\Models\Apointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apointment extends Model
{
    use HasFactory;

    protected $fillable = [
        "date","time_start","type" , "time_end", 'status', 'user_id',
    ];
}
