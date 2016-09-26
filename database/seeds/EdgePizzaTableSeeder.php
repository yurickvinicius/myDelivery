<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\EdgePizza;

class EdgePizzaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(EdgePizza::class)->create([
            'name' => 'Com Borda',
            'price' => 0,
        ]);

        factory(EdgePizza::class)->create([
            'name' => 'Sem Borda',
            'price' => 0,
        ]);

        factory(EdgePizza::class)->create([
            'name' => 'Catupiry',
            'price' => 3.5,
        ]);
    }

}
