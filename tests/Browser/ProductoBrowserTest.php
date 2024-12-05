<?php

namespace Tests\Browser;

use App\Models\Producto;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductoBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_ver_lista_de_productos()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/productos')
                    ->assertSee('Lista de Productos')
                    ->screenshot('lista_de_productos');
        });
    }

    public function test_crear_producto()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/productos/create')
                    ->type('#nombre-producto', 'Producto Test')
                    ->type('#precio-producto', '100.50')
                    ->type('#stock-producto', '10')
                    ->click('#btn-guardar-producto')
                    ->waitForLocation('/productos')
                    ->assertSee('Producto Test')
                    ->assertSee('100.50')
                    ->assertSee('10');
        });
    }

    public function test_editar_producto()
    {
        $producto = Producto::factory()->create([
            'nombre' => 'Producto Original',
            'precio' => 50.00,
            'stock' => 5,
        ]);

        $this->browse(function (Browser $browser) use ($producto) {
            $browser->visit("/productos/{$producto->id}/edit")
                    ->assertSee('Editar Producto')
                    ->type('#nombre-producto-edit', 'Producto Editado')
                    ->type('#precio-producto-edit', '75.00')
                    ->type('#stock-producto-edit', '15')
                    ->click('#btn-actualizar-producto')
                    ->waitForLocation('/productos')
                    ->assertSee('Producto Editado')
                    ->assertSee('75.00')
                    ->assertSee('15');
        });
    }

    public function test_cargar_formulario_crear_producto()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/productos/create')
                ->assertSee('Crear Producto')
                ->assertPresent('#nombre-producto')
                ->assertPresent('#precio-producto')
                ->assertPresent('#stock-producto')
                ->assertPresent('#btn-guardar-producto')
                ->screenshot('formulario_crear_producto');
    });
}
public function test_ver_datos_producto_en_lista()
{
    $producto = Producto::factory()->create([
        'nombre' => 'Producto en Lista',
        'precio' => 25.99,
        'stock' => 10,
    ]);

    $this->browse(function (Browser $browser) use ($producto) {
        $browser->visit('/productos')
                ->assertSee($producto->nombre)
                ->assertSee($producto->precio)
                ->assertSee($producto->stock)
                ->screenshot('producto_en_lista');
    });
}


public function test_editar_producto_inexistente()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/productos/999/edit')
                ->assertSee('404')
                ->screenshot('producto_inexistente');
    });
}



    public function test_lista_vacia_de_productos()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/productos')
                ->assertSee('No hay productos registrados actualmente.')
                ->screenshot('lista_vacia_productos');
    });
}

}
