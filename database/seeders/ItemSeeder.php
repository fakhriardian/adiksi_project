<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::factory()->count(27)->sequence(

            [
                'categories_id' => '1',
                'image' => 'americano.png',
                'name' => 'Americano',
                'desc' => 'Fresh coffee',
                'price' => '22000',
                'draft' => '0',
            ],
            [
                'categories_id' => '1',
                'image' => 'carmacchiato.png',
                'name' => 'Caramel Macchiato',
                'desc' => 'Fresh coffee',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '1',
                'image' => 'kopiitem.png',
                'name' => 'Kopi Item',
                'desc' => 'Fresh coffee',
                'price' => '18000',
                'draft' => '0',
            ],
            [
                'categories_id' => '2',
                'image' => 'chocolate.png',
                'name' => 'Chocolate',
                'desc' => 'Fresh drink',
                'price' => '26000',
                'draft' => '0',
            ],
            [
                'categories_id' => '2',
                'image' => 'koreanbanana.png',
                'name' => 'Korean Banana',
                'desc' => 'Fresh drink',
                'price' => '26000',
                'draft' => '0',
            ],
            [
                'categories_id' => '2',
                'image' => 'lycheemojito.png',
                'name' => 'Lychee Mojito',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '2',
                'image' => 'matcha.png',
                'name' => 'Matcha',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '3',
                'image' => 'cookiesncream.png',
                'name' => "Cookies n' Cream Frappe",
                'desc' => 'Cookies and Cream',
                'price' => '30000',
                'draft' => '0',
            ],
            [
                'categories_id' => '3',
                'image' => 'orannio.png',
                'name' => 'Orannio Boba',
                'desc' => 'Fresh drink',
                'price' => '25000',
                'draft' => '0',
            ],
            [
                'categories_id' => '3',
                'image' => 'redvelvet.png',
                'name' => 'Red Velvet',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '3',
                'image' => 'susupandan.png',
                'name' => 'Kopi Susu Pandan',
                'desc' => 'Fresh drink',
                'price' => '26000',
                'draft' => '0',
            ],
            [
                'categories_id' => '4',
                'image' => 'lycheeteayakult.png',
                'name' => 'Lychee Tea Yakult',
                'desc' => 'Fresh drink',
                'price' => '24000',
                'draft' => '0',
            ],
            [
                'categories_id' => '4',
                'image' => 'lycheetea.png',
                'name' => 'Lychee Tea',
                'desc' => 'Fresh drink',
                'price' => '26000',
                'draft' => '0',
            ],
            [
                'categories_id' => '4',
                'image' => 'javatea.png',
                'name' => 'Java Tea',
                'desc' => 'Fresh drink',
                'price' => '24000',
                'draft' => '0',
            ],
            [
                'categories_id' => '5',
                'image' => 'nagalychee.png',
                'name' => 'Naga Lychee',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '5',
                'image' => 'nagapisang.png',
                'name' => 'Naga Pisang',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '5',
                'image' => 'strawberrylychee.png',
                'name' => 'Strawberry Lychee',
                'desc' => 'Fresh drink',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '6',
                'image' => 'churros2.png',
                'name' => 'Churros',
                'desc' => 'Churros',
                'price' => '22000',
                'draft' => '0',
            ],
            [
                'categories_id' => '6',
                'image' => 'chickenskin.png',
                'name' => 'Crispy Chicken Skin',
                'desc' => 'Crispy Chicken Skin',
                'price' => '22000',
                'draft' => '0',
            ],
            [
                'categories_id' => '6',
                'image' => 'mixplatter.png',
                'name' => 'Mix Platter',
                'desc' => 'Mix Platter',
                'price' => '28000',
                'draft' => '0',
            ],
            [
                'categories_id' => '6',
                'image' => 'roticanai.png',
                'name' => 'Roti Canai',
                'desc' => 'Roti Canai',
                'price' => '22000',
                'draft' => '0',
            ],
            [
                'categories_id' => '6',
                'image' => 'waffle.png',
                'name' => 'Waffle',
                'desc' => 'Waffle',
                'price' => '24000',
                'draft' => '0',
            ],
            [
                'categories_id' => '7',
                'image' => 'beef_black_pepper.png',
                'name' => 'Beef Black Pepper',
                'desc' => 'Rice bowl with sunny side up egg and black pepper beef',
                'price' => '36000',
                'draft' => '0',
            ],
            [
                'categories_id' => '7',
                'image' => 'Chicken_salted_egg.png',
                'name' => 'Chicken Salted Egg',
                'desc' => 'Rice bowl with sunny side up egg and chicken with salted egg sauce',
                'price' => '36000',
                'draft' => '0',
            ],
            [
                'categories_id' => '7',
                'image' => 'ebi_furai.png',
                'name' => 'Ebi Furai',
                'desc' => 'Rice bowl with Ebi Furai',
                'price' => '32000',
                'draft' => '0',
            ],
            [
                'categories_id' => '7',
                'image' => 'katsu.png',
                'name' => 'Chicken Katsu',
                'desc' => 'Rice bowl with chicken katsu and sauce',
                'price' => '35000',
                'draft' => '0',
            ],
            [
                'categories_id' => '7',
                'image' => 'spaghetti_carbonara.png',
                'name' => 'Spaghetti Carbonara',
                'desc' => 'Spaghetti Carbonara',
                'price' => '36000',
                'draft' => '0',
            ],
        )->create();
    }
}
