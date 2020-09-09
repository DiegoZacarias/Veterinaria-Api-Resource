<?php

namespace Tests\Feature;

use App\Cita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CitaTest extends TestCase
{
  use RefreshDatabase, WithFaker;
    

  /** @test */
  public function se_puede_agregar_citas()
  {
      $fields = [
          'nombre_mascota' => 'Ketti',
          'nombre_dueno' => 'Diego',
          'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
          'hora' => $this->faker->time($format = 'H:i', $max = 'now'),
          'sintomas' => 'Ser genial'
      ];

      $this->withoutExceptionHandling();
      $this->post(route('citas.store'),$fields); //store

      $this->assertDatabaseHas('citas',$fields);
  }

    /** @test */
    public function se_puede_listas_todas_las_citas()
    {
        $citas = factory(Cita::class)->create();

        $this->withoutExceptionHandling();
        $this->get(route('citas.index'))->assertStatus(200);

    }
}
