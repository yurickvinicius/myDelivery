<?php

use Illuminate\Database\Seeder;

class FlavorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('myDelivery\Models\Flavor', 60)->create();
    }
}
