<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::factory()->count(2)->sequence(
            [
                'embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3069597767258!2d105.29623285015369!3d-5.370070496085714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dbebbec91f71%3A0x321fe3512e793ec8!2sAdiksi%20Coffee%20Korpri!5e0!3m2!1sid!2sid!4v1678265343545!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'store' => 'Adiksi Korpri'
            ],
            [
                'embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.242904543283!2d105.23803905015386!3d-5.379890396078667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dbc60356becf%3A0x3892607a352a3c13!2sADIKSI%20Coffee!5e0!3m2!1sid!2sid!4v1678265520966!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'store' => 'Adiksi Purnawirawan'
            ]
        )->create();
    }
}
