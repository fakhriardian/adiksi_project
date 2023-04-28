<?php

namespace Database\Seeders;

use App\Models\Socmed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Socmed::factory()->count(1)->sequence(
            [
                'insta' => 'https://www.instagram.com/adiksicoffee/?hl=id',
                'tiktok' => 'https://www.tiktok.com/@adiksicoffee',
                'telp' => '08787383738373',
            ]
        )->create();
    }
}
