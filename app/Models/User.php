<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'society_id',
        'email',
        'phone_no',
        'address',
        'society_member',
        'share_no',
        'current_loan_due_amount',
        'user_name',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }
    
    public function loan()
    {
        return $this->hasMany(Loan::class);
    }
    
    public function disburse()
    {
        return $this->hasMany(Disburse::class);
    }

    public function interest()
    {
        return $this->hasMany(Interest::class);
    }

    public function Interestnonpay()
    {
        return $this->hasMany(Interestnonpay::class);
    }

    public function expenditure()
    {
        return $this->hasMany(Expenditure::class);
    }
    

}