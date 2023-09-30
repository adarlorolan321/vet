<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'barangay',
        'mobile_no',
        'city',
        'province',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
       'role'
      ];

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->implode(', ');
    }
    protected static function  booted()
    {
        static::created(function ($user) {
            $user->name = $user->first_name . ' ' . $user->last_name;
            // $user->profile()->create([
            //     'first_name' => $user->first_name,
            //     'last_name' => $user->last_name,
            //     'email' => $user->email,
            // ]);
        });
        static::creating(function ($user) {
            $user->name = $user->first_name . ' ' . $user->last_name;
        });
        static::updating(function ($user) {
            $user->name = $user->first_name . ' ' . $user->last_name;
        });
    }
}
