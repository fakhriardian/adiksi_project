<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(2)->sequence(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => '1',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'customer',
                'email' => 'customer@gmail.com',
                'role' => '0',
                'password' => bcrypt('customer123'),
            ],
        )->create();
    }
}
