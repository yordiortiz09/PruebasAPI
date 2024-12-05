<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_cliente_en_base_de_datos()
    {
        Cliente::factory()->create([
            'nombre' => 'Ana Gómez',
            'correo' => 'ana@example.com',
            'telefono' => '0987654321',
        ]);

        $this->assertDatabaseHas('clientes', [
            'nombre' => 'Ana Gómez',
            'correo' => 'ana@example.com',
            'telefono' => '0987654321',
        ]);
    }
}
