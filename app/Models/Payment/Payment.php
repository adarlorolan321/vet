<?php

namespace App\Models\Payment;

use App\Models\Admin\VetService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id","amount","payment_method","payment_status","apointment_id",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
