<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_producto_via_ruta()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Producto Test',
            'precio' => 99.99,
            'stock' => 15,
        ]);

        $response->assertStatus(302); // Redirige después de guardar
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto Test',
            'precio' => 99.99,
            'stock' => 15,
        ]);
    }


    /** @test */
    public function puede_editar_producto_via_ruta()
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Producto Original',
            'precio' => 50.00,
            'stock' => 10,
        ]);

        $response = $this->put("/productos/{$producto->id}", [
            'nombre' => 'Producto Editado',
            'precio' => 75.00,
            'stock' => 20,
        ]);

        $response->assertStatus(302); // Redirige después de actualizar
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Producto Editado',
            'precio' => 75.00,
            'stock' => 20,
        ]);
    }

    /** @test */
    public function puede_eliminar_producto_via_ruta()
    {
        $producto = Producto::factory()->create();

        $response = $this->delete("/productos/{$producto->id}");

        $response->assertStatus(302); // Redirige después de eliminar
        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }

    /** @test */
    public function no_puede_crear_producto_con_datos_invalidos()
    {
        $response = $this->post('/productos', [
            'nombre' => '', // Nombre vacío
            'precio' => -10, // Precio negativo
            'stock' => 'abc', // Stock no numérico
        ]);

        $response->assertSessionHasErrors(['nombre', 'precio', 'stock']);
        $this->assertDatabaseCount('productos', 0); // Asegura que no se creó ningún producto
    }

    /** @test */
    public function puede_ver_lista_de_productos()
    {
        Producto::factory()->count(3)->create();

        $response = $this->get('/productos');

        $response->assertStatus(200);
        $response->assertSee('Lista de Productos');
    }





    /** @test */
    public function valida_precio_de_producto_no_negativo()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Producto Test',
            'precio' => -99.99, // Precio negativo
            'stock' => 10,
        ]);

        $response->assertSessionHasErrors(['precio']);
    }

    /** @test */
    public function valida_stock_de_producto_es_entero()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Producto Test',
            'precio' => 99.99,
            'stock' => 5.5, // Stock no entero
        ]);

        $response->assertSessionHasErrors(['stock']);
    }

    public function puede_mostrar_detalles_de_un_producto()
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Producto Detalle',
            'precio' => 120.50,
            'stock' => 30,
        ]);

        $response = $this->get("/productos/{$producto->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $producto->id,
            'nombre' => 'Producto Detalle',
            'precio' => 120.50,
            'stock' => 30,
        ]);
    }

    /** @test */
    public function puede_acceder_a_formulario_de_creacion()
    {
        $response = $this->get('/productos/create');

        $response->assertStatus(200);
        $response->assertSee('Crear Producto');
    }

    /** @test */
    public function puede_acceder_a_formulario_de_edicion()
    {
        $producto = Producto::factory()->create();

        $response = $this->get("/productos/{$producto->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Editar Producto');
    }

    /** @test */
    public function no_puede_actualizar_producto_con_datos_invalidos()
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Producto Original',
            'precio' => 100.00,
            'stock' => 50,
        ]);

        $response = $this->put("/productos/{$producto->id}", [
            'nombre' => '', // Nombre vacío
            'precio' => 'abc', // Precio no numérico
            'stock' => -5, // Stock negativo
        ]);

        $response->assertSessionHasErrors(['nombre', 'precio', 'stock']);
        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Producto Original',
            'precio' => 100.00,
            'stock' => 50,
        ]);
    }

    /** @test */
    public function elimina_producto_y_retorna_no_content_si_se_envia_json()
    {
        $producto = Producto::factory()->create();

        $response = $this->deleteJson("/productos/{$producto->id}");

        $response->assertStatus(204); // No Content
        $this->assertDatabaseMissing('productos', [
            'id' => $producto->id,
        ]);
    }

    /** @test */
    public function crea_producto_y_retorna_json_si_se_envia_json()
    {
        $response = $this->postJson('/productos', [
            'nombre' => 'Producto JSON',
            'precio' => 150.75,
            'stock' => 20,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'nombre' => 'Producto JSON',
            'precio' => 150.75,
            'stock' => 20,
        ]);
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto JSON',
            'precio' => 150.75,
            'stock' => 20,
        ]);
    }

    /** @test */
    public function no_puede_eliminar_producto_inexistente()
    {
        $response = $this->delete('/productos/9999'); // ID que no existe

        $response->assertStatus(404); // Not Found
    }

    /** @test */
    public function valida_redireccion_correcta_despues_de_eliminar_producto()
    {
        $producto = Producto::factory()->create();

        $response = $this->delete("/productos/{$producto->id}");

        $response->assertRedirect('/productos');
        $response->assertSessionHas('success', 'Producto eliminado con éxito.');
    }
}
