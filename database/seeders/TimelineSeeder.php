<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timeline::factory()->count(3)->sequence(
            [
                'name' => 'pesanan diterima',
                'value' => '1',
            ],
            [
                'name' => 'pesanan diproses',
                'value' => '2',
            ],
            [
                'name' => 'pesanan selesai',
                'value' => '3',
            ],
        )->create();
    }
}
