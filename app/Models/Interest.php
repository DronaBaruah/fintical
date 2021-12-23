<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'interest_id',
        'user_id',
        'society_id',
        'date',
        'previous_interest',
        'interest_amount',
        'lif_amount',
        'total_interest',
        'remark',
        'status',
        'admin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}