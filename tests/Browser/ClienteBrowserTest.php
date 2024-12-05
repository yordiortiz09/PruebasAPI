<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_tabla_de_clientes()
    {

        Cliente::factory()->count(3)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/clientes')
                    ->assertSee('ID')
                    ->assertSee('Nombre')
                    ->assertSee('Correo')
                    ->assertSee('Teléfono');
        });
    }

    public function test_ver_lista_de_clientes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/clientes')
                    ->assertSee('Lista de Clientes')
                    ->screenshot('clientes_error');
        });
    }

    public function test_crear_cliente()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/clientes/create')
                    ->type('#nombre-cliente', 'Juan Pérez')
                    ->type('#correo-cliente', 'juan@example.com')
                    ->type('#telefono-cliente', '1234567890')
                    ->click('#btn-guardar-cliente')
                    ->waitForLocation('/clientes')
                    ->assertSee('Juan Pérez');
        });

    }

    public function test_editar_cliente()
    {
        $cliente = Cliente::factory()->create([
            'nombre' => 'Juan Pérez',
            'correo' => 'juan@example.com',
            'telefono' => '1234567890',
        ]);

        $this->browse(function (Browser $browser) use ($cliente) {
            $browser->visit("/clientes/{$cliente->id}/edit")
                    ->assertSee('Editar Cliente')
                    ->type('#nombre-cliente-edit', 'Luis Gómez')
                    ->click('#btn-actualizar-cliente')
                    ->waitForLocation('/clientes')
                    ->assertSee('Luis Gómez');
        });
    }


    public function test_ver_detalle_cliente()
    {
        $cliente = Cliente::factory()->create([
            'nombre' => 'Juan Pérez',
            'correo' => 'juan@example.com',
            'telefono' => '1234567890',
        ]);

        $this->browse(function (Browser $browser) use ($cliente) {
            $browser->visit(route('clientes.edit', $cliente->id))
                    ->assertSee('Editar Cliente')
                    ->assertInputValue('#nombre-cliente-edit', $cliente->nombre)
                    ->assertInputValue('#correo-cliente-edit', $cliente->correo)
                    ->assertInputValue('#telefono-cliente-edit', $cliente->telefono);
        });
    }

public function test_enlace_crear_cliente()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/clientes')
                ->assertSeeLink('Crear Cliente')
                ->clickLink('Crear Cliente')
                ->assertPathIs('/clientes/create');
    });
}


public function test_volver_a_lista_desde_crear_cliente()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/clientes/create')
                ->clickLink('Clientes')
                ->assertPathIs('/clientes')
                ->assertSee('Lista de Clientes');
    });
}

public function test_visualizar_datos_en_tabla()
{
    Cliente::factory()->create([
        'nombre' => 'Cliente Prueba',
        'correo' => 'prueba@cliente.com',
        'telefono' => '1234567890',
    ]);

    $this->browse(function (Browser $browser) {
        $browser->visit('/clientes')
                ->assertSee('Cliente Prueba')
                ->assertSee('prueba@cliente.com')
                ->assertSee('1234567890');
    });
}




    public function test_eliminar_cliente()
    {
        $cliente = Cliente::factory()->create([
            'nombre' => 'Juan Pérez',
            'correo' => 'juan@example.com',
            'telefono' => '1234567890',
        ]);

        $this->browse(function (Browser $browser) use ($cliente) {
            $browser->visit('/clientes')
                    ->assertSee($cliente->nombre)
                    ->click("#btn-eliminar-{$cliente->id}")
                    ->waitUntilMissing("#cliente-{$cliente->id}")
                    ->assertDontSee($cliente->nombre);
        });
    }

}
