<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call('ClientsTableSeeder');
        $this->call('DrinkTableSeeder');
        $this->call('EdgePizzaTableSeeder');
        $this->call('SizePizzaTableSeeder');
        $this->call('FlavorTableSeeder');
        $this->call('DeliveryMeanTableSeeder');
    }
}
