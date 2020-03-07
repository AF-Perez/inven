<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function un_admin_puede_registrar_usuarios()
    {
        // $this->withoutExceptionHandling();
        // setup de datos

        // login
        // TODO otorgarle rol de administador
        $admin = factory(\App\User::class)->create();

        // $user->assignRole('Super Admin');

        $this->actingAs($admin);

        $atributos = [
            'email' => $this->faker->email,
            'nombres' => 'Daniela',
            'apellidos' => 'Ortega',
            'cedula' => $this->faker->randomNumber(9, true)
        ];

        // intenta crear usuario
        $response = $this->post('/regular-users/ingresar', $atributos);

        // como resultado el nuevo usario se encuentra en la base de datos
        $this->assertDatabaseHas('users', [
            'cedula' => $atributos['cedula'],
        ]);

    }

    protected function tearDown(): void
    {
        // eliminar todos los registros creados
        \App\User::truncate();
    }
}
