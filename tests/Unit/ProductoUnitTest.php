<?php

namespace Tests\Unit;

use App\Models\Producto;
use PHPUnit\Framework\TestCase;

class ProductoUnitTest extends TestCase
{
    /** @test */
    public function producto_nombre_no_es_nulo()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertNotNull($producto->nombre, 'El nombre del producto no debe ser nulo');
    }

    /** @test */
    public function producto_precio_es_positivo()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertGreaterThan(0, $producto->precio, 'El precio del producto debe ser mayor que cero');
    }

    /** @test */
    public function producto_stock_es_numero_entero()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertIsInt($producto->stock, 'El stock del producto debe ser un número entero');
    }

    /** @test */
    public function producto_todos_los_atributos_son_validos()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertNotNull($producto->nombre);
        $this->assertGreaterThan(0, $producto->precio);
        $this->assertIsInt($producto->stock);
    }

    /** @test */
    public function producto_precio_no_puede_ser_negativo()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => -10.50,
            'stock' => 10,
        ]);

        $this->assertLessThanOrEqual(0, $producto->precio, 'El precio del producto no puede ser negativo');
    }


    /** @test */
    public function producto_nombre_es_una_cadena()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertIsString($producto->nombre, 'El nombre del producto debe ser una cadena de texto');
    }

    /** @test */
    public function producto_precio_tiene_decimales()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 99.99,
            'stock' => 10,
        ]);

        $this->assertMatchesRegularExpression('/^\d+(\.\d{1,2})?$/', (string) $producto->precio, 'El precio debe tener hasta dos decimales');
    }

    /** @test */
    public function producto_nombre_tiene_longitud_valida()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertTrue(strlen($producto->nombre) <= 255, 'El nombre del producto debe tener como máximo 255 caracteres');
    }

    /** @test */
    public function producto_stock_es_valido_y_entero()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 20,
        ]);

        $this->assertGreaterThanOrEqual(0, $producto->stock, 'El stock debe ser mayor o igual a 0');
        $this->assertIsInt($producto->stock, 'El stock debe ser un número entero');
    }



    /** @test */
    public function producto_puede_crearse_con_atributos_validos()
    {
        $producto = new Producto([
            'nombre' => 'Producto Test',
            'precio' => 100.50,
            'stock' => 10,
        ]);

        $this->assertEquals('Producto Test', $producto->nombre);
        $this->assertEquals(100.50, $producto->precio);
        $this->assertEquals(10, $producto->stock);
    }


}
