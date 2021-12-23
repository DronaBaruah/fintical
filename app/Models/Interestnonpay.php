<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interestnonpay extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'interest_non_pay_id',
        'user_id',
        'society_id',
        'date',
        'interest_non_pay',
        'remark',
        'status',
        'admin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}