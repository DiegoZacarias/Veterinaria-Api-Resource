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
  public function se_pueden_agregar_citas()
  {
      $fields = [
          'nombre_mascota' => 'Ketti',
          'nombre_dueno' => 'Diego',
          'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
          'hora' => $this->faker->time($format = 'H:i', $max = 'now'),
          'sintomas' => 'Ser genial'
      ];

      $this->withoutExceptionHandling();

      $response = $this->json('POST', route('citas.store'),$fields);  
        $response->assertStatus(201);

      $this->assertDatabaseHas('citas',$fields);
  }

    /** @test */
    public function se_pueden_listar_todas_las_citas()
    {
        $citas = factory(Cita::class,3)->create();

       
        $response = $this->json('GET', route('citas.index'));
        $response
            ->assertStatus(200);

        // $this->assertInstanceOf(Collection::class,$citas);

    }

    /** @test */
    public function se_puede_eliminar_la_lista()
    {
        $cita = factory(Cita::class)->create();

        $response = $this->json('DELETE', route('citas.destroy',$cita->id));  
        $response->assertStatus(204);

        $this->assertDatabaseMissing('citas',['id' => $cita->id]);
    }
}


