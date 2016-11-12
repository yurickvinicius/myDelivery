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
            'name' => 'Yurick',
            'cep' => '85015-410',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Santa Cruz',
            'address' => 'Engenheiro Antonio Rebouças',
            'number' => '460',
            'complement' => 'prox aos condominio ouro preto',
            'phone' => '4230355240',
            'cell_phone' => '4299921178',
            'user_id' => 1
        ]);

        factory(Client::class)->create([
            'name' => 'Ana Carolina',
            'cep' => '85067-712',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Vila Carli',
            'address' => 'Padre Sagrado',
            'number' => '25',
            'complement' => '',
            'phone' => '4232255343',
            'cell_phone' => '4296211332',
            'user_id' => 2
        ]);

        factory(Client::class)->create([
            'name' => 'João Mineiro',
            'cep' => '84567-712',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Bairro dos Estados',
            'address' => 'Ana Joaquina',
            'number' => '112',
            'complement' => '',
            'phone' => '4232134432',
            'cell_phone' => '4296211223',
            'user_id' => 3
        ]);

        factory(Client::class)->create([
            'name' => 'Yara Rocha',
            'cep' => '85067-112',
            'state' => 'PR',
            'city' => 'Guarapuava',
            'neighborhood' => 'Vila Bela',
            'address' => 'Rua Sagrado',
            'number' => '554',
            'complement' => 'prox a um lugar secreto',
            'phone' => '4244335343',
            'cell_phone' => '4296211123',
            'user_id' => 4
        ]);
    }

}
