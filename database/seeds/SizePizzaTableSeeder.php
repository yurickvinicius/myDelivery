<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\SizePizza;

class SizePizzaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(SizePizza::class)->create([
            'size' => 'Pequena',
            'parts' => 1,
            'price' => 25.00,
            'pieces' => 8
        ]);

        factory(SizePizza::class)->create([
            'size' => 'Média',
            'parts' => 2,
            'price' => 30.00,
            'pieces' => 10
        ]);

        factory(SizePizza::class)->create([
            'size' => 'Grande',
            'parts' => 3,
            'price' => 35.00,
            'pieces' => 12
        ]);

        factory(SizePizza::class)->create([
            'size' => 'Família',
            'parts' => 4,
            'price' => 40.00,
            'pieces' => 16
        ]);
    }

}
