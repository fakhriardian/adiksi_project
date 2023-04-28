<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'hero_image',
        'hero_caption',
        'hero_head',
        'hero_desc',
        'card_image',
        'card_head',
        'card_desc',
        'card_quote',
        'hl_head',
        'hl_desc',
        'hl_image1',
        'hl_capt1',
        'hl_image2',
        'hl_capt2',
        'hl_image3',
        'hl_capt3',
        'hl_image4',
        'hl_capt4',
        'mt_image',
        'mt_head',
        'mt_desc',
        'image1',
        'image2',
        'image3',
        'image4',
    ];
}
