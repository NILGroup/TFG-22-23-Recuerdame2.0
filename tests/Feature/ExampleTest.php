<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Rol;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
    /** @test */
    public function pruebaBBDD()
    {
        $this->assertDatabaseHas('rols', ["id" => 1, "nombre" => "Terapeuta"]);
    }

    /** @test */
    public function esteTestFalla()
    {
        $this->assertTrue(false);
    }
}
