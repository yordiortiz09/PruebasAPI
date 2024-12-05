<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_cliente_via_ruta()
    {
        $response = $this->post('/clientes', [
            'nombre' => 'Pedro López',
            'correo' => 'pedro@example.com',
            'telefono' => '1122334455',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('clientes', [
            'nombre' => 'Pedro López',
            'correo' => 'pedro@example.com',
            'telefono' => '1122334455',
        ]);
    }
}
