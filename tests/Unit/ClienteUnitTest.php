<?php

namespace Tests\Unit;

use App\Models\Cliente;
use PHPUnit\Framework\TestCase;

class ClienteUnitTest extends TestCase
{
    public function test_nombre_cliente_valido()
    {
        $cliente = new Cliente([
            'nombre' => 'Juan Pérez',
            'correo' => 'juan@example.com',
            'telefono' => '1234567890',
        ]);

        $this->assertEquals('Juan Pérez', $cliente->nombre);
        $this->assertEquals('juan@example.com', $cliente->correo);
        $this->assertEquals('1234567890', $cliente->telefono);
    }

    public function test_cliente_correo_invalido()
    {
        $cliente = new Cliente([
            'nombre' => 'Ana López',
            'correo' => 'correo_invalido',
            'telefono' => '9876543210',
        ]);

        $this->assertNotEquals('ana@domain.com', $cliente->correo);
    }

    public function test_cliente_telefono_con_caracteres_no_validos()
    {
        $cliente = new Cliente([
            'nombre' => 'Carlos Martínez',
            'correo' => 'carlos@example.com',
            'telefono' => '12345abcde',
        ]);

        $this->assertNotEquals('1234567890', $cliente->telefono);
    }

    public function test_cliente_atributos_faltantes()
    {
        $cliente = new Cliente([
            'nombre' => null,
            'correo' => null,
            'telefono' => null,
        ]);

        $this->assertNull($cliente->nombre);
        $this->assertNull($cliente->correo);
        $this->assertNull($cliente->telefono);
    }

    public function test_cliente_telefono_de_longitud_valida()
    {
        $cliente = new Cliente([
            'nombre' => 'Pedro López',
            'correo' => 'pedro@example.com',
            'telefono' => '1234567890',
        ]);

        $this->assertTrue(strlen($cliente->telefono) === 10);
    }

    public function test_crear_cliente_y_validar_atributos()
    {
        $cliente = new Cliente([
            'nombre' => 'Laura Gómez',
            'correo' => 'laura@example.com',
            'telefono' => '0987654321',
        ]);

        $this->assertArrayHasKey('nombre', $cliente->getAttributes());
        $this->assertArrayHasKey('correo', $cliente->getAttributes());
        $this->assertArrayHasKey('telefono', $cliente->getAttributes());
    }

    public function test_cliente_telefono_solo_numerico()
    {
        $cliente = new Cliente([
            'nombre' => 'Sofía Torres',
            'correo' => 'sofia@example.com',
            'telefono' => '123abc7890',
        ]);

        $this->assertMatchesRegularExpression('/^\d+$/', $cliente->telefono, 'El teléfono contiene caracteres no numéricos');
    }

    public function test_cliente_nombre_no_nulo()
    {
        $cliente = new Cliente([
            'nombre' => 'Luis Fernández',
            'correo' => 'luis@example.com',
            'telefono' => '4567890123',
        ]);

        $this->assertNotNull($cliente->nombre, 'El nombre del cliente no debe ser nulo');
    }

    public function test_cliente_correo_formato_valido()
    {
        $cliente = new Cliente([
            'nombre' => 'María Pérez',
            'correo' => 'correo_invalido',
            'telefono' => '9876543210',
        ]);

        $this->assertDoesNotMatchRegularExpression('/^.+@.+\..+$/', $cliente->correo, 'El correo no tiene un formato válido');
    }
}
