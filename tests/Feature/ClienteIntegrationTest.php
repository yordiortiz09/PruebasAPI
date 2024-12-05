<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_cliente_en_la_base_de_datos()
    {
        $response = $this->post('/clientes', [
            'nombre' => 'Carlos García',
            'correo' => 'carlos@example.com',
            'telefono' => '1234567890',
        ]);

        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', [
            'nombre' => 'Carlos García',
            'correo' => 'carlos@example.com',
            'telefono' => '1234567890',
        ]);
    }

    /** @test */
    public function no_puede_crear_cliente_con_datos_invalidos()
    {
        $response = $this->post('/clientes', [
            'nombre' => '',
            'correo' => 'correo-invalido',
            'telefono' => 'abcd1234',
        ]);

        $response->assertSessionHasErrors(['nombre', 'correo', 'telefono']);
        $this->assertDatabaseCount('clientes', 0);
    }

    /** @test */
    public function puede_actualizar_cliente()
    {
        $cliente = Cliente::factory()->create([
            'nombre' => 'Ana Pérez',
            'correo' => 'ana@example.com',
            'telefono' => '1234567890',
        ]);

        $response = $this->put("/clientes/{$cliente->id}", [
            'nombre' => 'Ana Actualizada',
            'correo' => 'ana@actualizado.com',
            'telefono' => '0987654321',
        ]);

        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nombre' => 'Ana Actualizada',
            'correo' => 'ana@actualizado.com',
            'telefono' => '0987654321',
        ]);
    }

    /** @test */
    public function no_puede_actualizar_cliente_con_datos_invalidos()
    {
        $cliente = Cliente::factory()->create([
            'nombre' => 'Luis Gómez',
            'correo' => 'luis@example.com',
            'telefono' => '1234567890',
        ]);

        $response = $this->put("/clientes/{$cliente->id}", [
            'nombre' => '',
            'correo' => 'correo-no-valido',
            'telefono' => 'abc123',
        ]);

        $response->assertSessionHasErrors(['nombre', 'correo', 'telefono']);
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nombre' => 'Luis Gómez',
            'correo' => 'luis@example.com',
            'telefono' => '1234567890',
        ]);
    }

    /** @test */
    public function puede_eliminar_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->delete("/clientes/{$cliente->id}");

        $response->assertRedirect('/clientes');
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }

    /** @test */
    public function no_puede_eliminar_cliente_inexistente()
    {
        $response = $this->delete('/clientes/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function puede_ver_lista_de_clientes()
    {
        Cliente::factory()->count(3)->create();

        $response = $this->get('/clientes');

        $response->assertStatus(200);
        $response->assertSee('Lista de Clientes');
    }

      /** @test */

















      /** @test */
      public function no_puede_obtener_datos_de_cliente_inexistente()
      {
          $response = $this->get('/clientes/999');

          $response->assertStatus(405);
      }


      /** @test */
      public function no_puede_crear_cliente_sin_nombre()
      {
          $response = $this->post('/clientes', [
              'correo' => 'correo@example.com',
              'telefono' => '1234567890',
          ]);

          $response->assertSessionHasErrors(['nombre']);
          $this->assertDatabaseCount('clientes', 0);
      }

      /** @test */
      public function no_puede_crear_cliente_con_correo_duplicado()
      {
          Cliente::factory()->create([
              'nombre' => 'Cliente Original',
              'correo' => 'duplicado@example.com',
              'telefono' => '1234567890',
          ]);

          $response = $this->post('/clientes', [
              'nombre' => 'Cliente Duplicado',
              'correo' => 'duplicado@example.com',
              'telefono' => '0987654321',
          ]);

          $response->assertSessionHasErrors(['correo']);
          $this->assertDatabaseCount('clientes', 1);
      }

      /** @test */
      public function no_puede_crear_cliente_con_telefono_duplicado()
      {
          Cliente::factory()->create([
              'nombre' => 'Cliente Original',
              'correo' => 'correo@example.com',
              'telefono' => '1234567890',
          ]);

          $response = $this->post('/clientes', [
              'nombre' => 'Cliente Duplicado',
              'correo' => 'nuevo@example.com',
              'telefono' => '1234567890',
          ]);

          $response->assertSessionHasErrors(['telefono']);
          $this->assertDatabaseCount('clientes', 1);
      }

      /** @test */
      public function puede_verificar_que_no_hay_clientes_registrados()
      {
          $response = $this->get('/clientes');

          $response->assertStatus(200);
          $response->assertSee('No hay clientes registrados actualmente.');
      }

      /** @test */
      public function puede_crear_y_verificar_clientes_registrados()
      {
          Cliente::factory()->count(5)->create();

          $response = $this->get('/clientes');

          $response->assertStatus(200);
          $response->assertDontSee('No hay clientes registrados actualmente.');
      }

      /** @test */
      public function puede_validar_telefono_con_longitud_incorrecta()
      {
          $response = $this->post('/clientes', [
              'nombre' => 'Cliente Test',
              'correo' => 'correo@example.com',
              'telefono' => '1234',
          ]);

          $response->assertSessionHasErrors(['telefono']);
      }

      /** @test */
      public function puede_validar_telefono_con_caracteres_invalidos()
      {
          $response = $this->post('/clientes', [
              'nombre' => 'Cliente Test',
              'correo' => 'correo@example.com',
              'telefono' => 'abcd1234',
          ]);

          $response->assertSessionHasErrors(['telefono']);
      }
}
