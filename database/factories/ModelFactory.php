<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(myDelivery\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'role' => 'Cliente',
        'remember_token' => str_random(10),
    ];
});

$factory->define(myDelivery\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'cep' => $faker->postcode,
        'state' => $faker->state,
        'city' => $faker->city,
        'neighborhood' => 'Santa Maria',
        'address' => $faker->address,
        'number' => $faker->buildingNumber,
        'complement' => $faker->text,
        'phone' => $faker->phoneNumber,
        'cell_phone' => $faker->phoneNumber,
        'user_id' => $faker->numberBetween(1, 10)
    ];
});

$factory->define(myDelivery\Models\Drink::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'price' => 5.50
    ];
});

$factory->define(myDelivery\Models\EdgePizza::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'price' => 0
    ];
});

$factory->define(myDelivery\Models\SizePizza::class, function (Faker\Generator $faker) {
    return [
        'size' => $faker->word,
        'price' => 20.00,
        'pieces' => 5
    ];
});

$factory->define(myDelivery\Models\Flavor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(10, 50)
    ];
});

$factory->define(myDelivery\Models\DeliveryMean::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'price' => 5.50
    ];
});
