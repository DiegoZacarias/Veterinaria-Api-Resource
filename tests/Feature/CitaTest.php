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
        $citas = factory(Cita::class,2)->create();

        

        $response = $this->json('GET', route('citas.index'));
        $response
            ->assertStatus(200)
            ->assertJson([
                [     
                      'id' => $citas[0]->id, 
                      'nombre_mascota' => $citas[0]->nombre_mascota,
                      'nombre_dueno' => $citas[0]->nombre_dueno,
                      'fecha' => $citas[0]->fecha,
                      'hora' => $citas[0]->hora,
                      'sintomas' => $citas[0]->sintomas 
                ],    
                [     
                      'id' => $citas[1]->id, 
                      'nombre_mascota' => $citas[1]->nombre_mascota,
                      'nombre_dueno' => $citas[1]->nombre_dueno,
                      'fecha' => $citas[1]->fecha,
                      'hora' => $citas[1]->hora,
                      'sintomas' => $citas[1]->sintomas
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'nombre_mascota', 'nombre_dueno', 'fecha', 'hora','sintomas'],
            ]);

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


