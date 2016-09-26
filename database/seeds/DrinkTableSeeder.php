<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\Drink;

class DrinkTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(Drink::class)->create([
            'name' => 'Coca Cola 2 litros',
            'price' => '5.50'
        ]);

        factory(Drink::class)->create([
            'name' => 'Fanta Laranja 2 litros',
            'price' => '5.00'
        ]);

        factory(Drink::class)->create([
            'name' => 'Sprite 2 litros',
            'price' => '5.00'
        ]);

        factory(Drink::class)->create([
            'name' => 'Guaraná 2 litros',
            'price' => '5.00'
        ]);

        ///factory('myDelivery\Models\Drink', 10)->create();
    }

}
