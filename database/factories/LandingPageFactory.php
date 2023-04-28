<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandingPage>
 */
class LandingPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hero_image' => '',
            'hero_caption' => '',
            'hero_head' => '',
            'hero_desc' => '',
            'card_image' => '',
            'card_head' => '',
            'card_desc' => '',
            'card_quote' => '',
            'hl_head' => '',
            'hl_desc' => '',
            'hl_image1' => '',
            'hl_image2' => '',
            'hl_image3' => '',
            'hl_image4' => '',
            'mt_image' => '',
            'mt_head' => '',
            'mt_desc' => '',
            'image1' => '',
            'image2' => '',
            'image3' => '',
            'image4' => '',
        ];
    }
}
