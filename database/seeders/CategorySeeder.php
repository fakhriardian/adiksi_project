<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::factory()->count(7)->sequence(
            [
                'icon' => '<i class="fa-solid fa-mug-saucer"></i>',
                'name' => 'Coffee'
            ],
            [
                'icon' => '<i class="fa-solid fa-wine-glass"></i>',
                'name' => 'Non-Coffee'
            ],
            [
                'icon' => '<i class="fa-solid fa-star"></i>',
                'name' => 'Signature'
            ],
            [
                'icon' => '<i class="fa-solid fa-whiskey-glass"></i>',
                'name' => 'Tea'
            ],
            [
                'icon' => '<i class="fa-solid fa-glass-water"></i>',
                'name' => 'Juice'
            ],
            [
                'icon' => '<i class="fa-solid fa-cookie-bite"></i>',
                'name' => 'Snack'
            ],
            [
                'icon' => '<i class="fa-solid fa-bowl-rice"></i>',
                'name' => 'Food'
            ],
        )->create();
    }
}
