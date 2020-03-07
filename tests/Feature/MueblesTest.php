<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;;



class MueblesTest extends TestCase
{
    /**
     * @test
     */
    public function un_usuario_puede_visualizar_una_tabla_con_todos_los_muebles()
    {   
        // $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();
        
        $muebles = \App\Mueble::all();
        $response = $this->actingAs($user)
                         ->get('/muebles');

        // $response->assertSee($muebles[1]->nombre);

        $response->assertStatus(200);
    }
}
