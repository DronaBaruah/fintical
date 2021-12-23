<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disburse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'disburse_id',
        'user_id',
        'society_id',
        'date',
        'amount',
        'status',
        'remark',
        'admin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}