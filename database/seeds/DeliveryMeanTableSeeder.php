<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\DeliveryMean;

class DeliveryMeanTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(DeliveryMean::class)->create([
            'name' => 'Retirada no balcão',
            'price' => '0.00'
        ]);

        factory(DeliveryMean::class)->create([
            'name' => 'Entrega',
            'price' => '3.00'
        ]);
    }

}
