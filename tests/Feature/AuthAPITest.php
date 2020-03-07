<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthAPITest extends TestCase
{
    /** @test */
    public function usuario_se_puede_loguear_atraves_de_la_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        // preparar data
        $data = [
            'email' => $user->email,
            'password' => 'Password123',
        ];

        // intentar la petición
        $respuesta = $this->json('POST', '/api/login', $data);

        // valorar el resultado
        $respuesta->assertStatus(201);
    }
}
