<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'society_id',
        'address',
        'share_value',
        'phone_no',
        'society_type',
        'lending_interest_rate',
        'society_start',
        'society_end',
        'status',
    ];

    
}