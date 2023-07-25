<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_email',
        'username',
        'date',
        'start_time',
        'end_time',
        'durasi',
        'total',
        'status',
        'active',
        'capacity'
    ];
}
