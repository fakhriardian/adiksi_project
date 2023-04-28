<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPage::factory()->count(1)->sequence(
            [
                'hero_image'   => 'adiksi3.png',
                'hero_caption' => 'Workspace & Meal',
                'hero_head'    => 'In Fresh, Health, and Qualified',
                'hero_desc'    => 'Revolutionize of workspace. We offer coffee, food, drinks & dessert based on the highest quality ingridients and a place for your best workspaces and meetings.',
                'card_image'   => 'adiksi1.png',
                'card_head'    => 'Quality from seed to cup',
                'card_desc'    => 'A cup of coffee is the one of the most important, simple pleasure in life.',
                'card_quote'   => 'Drinking coffee is one of the most global things you do each day.',
                'hl_head'      => 'Featured dishes that people like',
                'hl_desc'      => 'A progression of rare and beautiful ingridients where texture, flavour and harmony is paramount.',
                'hl_image1'    => 'dishsample1.png',
                'hl_capt1'     => 'Coffee Latte',
                'hl_image2'    => 'dishsample2.png',
                'hl_capt2'     => 'Rice Bowl Karage',
                'hl_image3'    => 'dishsample3.png',
                'hl_capt3'     => 'Spaghetti Aglio Olio',
                'hl_image4'    => 'dishsample4.png',
                'hl_capt4'     => 'Nachos',
                'mt_image'     => 'meetingroom.png',
                'mt_head'      => 'Revolutionize Your Workspace',
                'mt_desc'      => 'Revolutionize of workspace. We offer coffee, food, drinks & dessert based on the highest quality ingridients -- and a place for your best workspace and meetings.',
                'image1'       => 'adiksisample1.png',
                'image2'       => 'adiksisample2.png',
                'image3'       => 'adiksisample3.png',
                'image4'       => 'adiksisample4.png',
            ],
        )->create();
    }
}
