<?php

use Faker\Generator as Faker;

$factory->define(App\Bien::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'descripcion' => $faker->paragraph,
        'clase' => 'CONTROL ADMINISTRATIVO',
        'id_ubicacion' => $faker->numberBetween($min = 1, $max = 10),
        'fecha_de_adquisicion' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'acta_de_recepcion' => 'dummy_binary',
        'imagen' => 'dummy_binary',
        'observaciones' => $faker->sentence,
        'valor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000),
    ];
});

$factory->define(App\BienControlAdministrativo::class, function (Faker $faker) {
    return [
        'id_bien' => $faker->randomDigit,
        'codigo' => $faker->unique()->bankAccountNumber,
        'peligrosidad' => $faker->word,
        'periodo_de_garantia' => $faker->randomDigit,
        'estado' => $faker->word,
        'caducidad' => $faker->word,
        'peligrosidad' => $faker->word,
        'manejo_especial' => $faker->word,
        'vida_util' => $faker->randomDigit,
        'id_actividad' => $faker->randomDigit,
        'en_uso' => $faker->randomDigit,
    ];
});

$factory->define(App\Mueble::class, function (Faker $faker) {
    return [
        'id_bien_control_administrativo' =>  $faker->randomDigit,
        'id_tipo_de_bien' =>  $faker->randomDigit,
        'color' => $faker->colorName,
        'dimensiones' => $faker->word,
    ];
});
