<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
          DB::table('users')->truncate();
          factory('myDelivery\Models\User')->create(
          [
          'name' => 'yurick',
          'email' => 'yurick@gmail.com',
          'password' => Hash::make('12345')
          ]
          );
         */

        factory(User::class)->create([
            'name' => 'Yurick Vinicius Ribas',
            'email' => 'yurick@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'Administrador',
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create([
            'name' => 'Ana Carolina Rossoni',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'Cliente',
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create([
            'name' => 'Joao Mineiro Da Silva',
            'email' => 'joao@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'Entregador',
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create([
            'name' => 'Pedro Ribeiro Campos',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'Entregador',
            'remember_token' => str_random(10),
        ]);

        ///factory('myDelivery\Models\User', 10)->create();
    }

}
