<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_email',
        'image',
        'name',
        'price',
        'qty',
        'option',
        'total',
        'status',
        'order_id'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
