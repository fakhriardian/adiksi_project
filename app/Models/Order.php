<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_email',
        'user_name',
        'order_id',
        'total',
        'tableNumber',
        'status',
        'paymentMethod',
        'active',
        'timelines_id'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'order_id');
    }
    public function timelines()
    {
        return $this->belongsTo(Timeline::class);
    }
}
