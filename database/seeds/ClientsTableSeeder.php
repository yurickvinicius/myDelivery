<?php

use Illuminate\Database\Seeder;
use myDelivery\Models\Client;

class ClientsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Client::class)->create([
            'cep' => '85015-410',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Santa Cruz',
            'address' => 'Engenheiro Antonio Rebouças',
            'number' => '460',
            'complement' => 'prox aos condominio ouro preto',
            'phone' => '(42)3035-5240',
            'cell_phone' => '(42)9992-1178',
            'user_id' => 1
        ]);

        factory(Client::class)->create([
            'cep' => '85067-712',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Vila Carli',
            'address' => 'Padre Sagrado',
            'number' => '25',
            'complement' => '',
            'phone' => '(42)3225-5343',
            'cell_phone' => '(42)9621-1332',
            'user_id' => 2
        ]);

        factory(Client::class)->create([
            'cep' => '84567-712',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Bairro dos Estados',
            'address' => 'Ana Joaquina',
            'number' => '112',
            'complement' => '',
            'phone' => '(42)3213-4432',
            'cell_phone' => '(42)9621-1223',
            'user_id' => 3
        ]);

        factory(Client::class)->create([
            'cep' => '85067-112',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Vila Bela',
            'address' => 'Rua Sagrado',
            'number' => '554',
            'complement' => 'prox a um lugar secreto',
            'phone' => '(42)4433-5343',
            'cell_phone' => '(42)9621-1123',
            'user_id' => 4
        ]);
    }

}
