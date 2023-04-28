<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'categories_id',
        'image',
        'name',
        'desc',
        'price'
    ];
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}