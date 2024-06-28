<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VapoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_CrearUnVapo()
    {
        $datos = [
            "marca" => "Sony",
            "modelo" => "Vapo1",
            "color" => "rojo",
            "potencia_maxima" => 50,
            "cantidad_de_pilas" => 2,
            "capacidad" => 100
        ];

        $response = $this->post('/insertar',$datos);
        $response->assertStatus(302);
        $response->assertLocation("/");
        $response->assertSessionHas("mensaje","Vapo insertado correctamente");
        $this->assertDatabaseHas('vapos', $datos);
    }

    public function test_EliminarUnVapo(){
        $response = $this->get('/eliminar/15');
        $response->assertStatus(302);
        $response->assertLocation("/");
        $response->assertSessionHas("mensaje","Vapo eliminado correctamente");
        $this->assertDatabaseMissing('vapos', ["id" => 15, "deleted_at" => null]);
    }

    public function test_EliminarUnVapoQueNoExiste(){
        $response = $this->get('/eliminar/1000');
        $response->assertStatus(404);
    }

    public function test_ListarVapos(){
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs("Listar");
        $response->assertViewHas("vapos");
        
    }

    public function test_ModificarVapo(){
        $datos = [
            "id" => 20,
            "marca" => "Sony",
            "modelo" => "Vapo1",
            "color" => "rojo",
            "potencia_maxima" => 50,
            "cantidad_de_pilas" => 2,
            "capacidad" => 100
        ];

        $response = $this->post('/modificar',$datos);
        $response->assertStatus(302);
        $response->assertLocation("/");
        $response->assertSessionHas("mensaje","Vapo modificado correctamente");
        $this->assertDatabaseHas('vapos', $datos);
    }

    public function test_MostrarFormularioDeEdicion(){
        $response = $this->get('/modificar/20');
        $response->assertStatus(200);
        $response->assertViewIs("editar");
        $response->assertViewHas("vapo");
    }

    public function test_MostrarFormularioDeEdicionDeUnVapoQueNoExiste(){
        $response = $this->get('/modificar/1000');
        $response->assertStatus(404);
    }
}
