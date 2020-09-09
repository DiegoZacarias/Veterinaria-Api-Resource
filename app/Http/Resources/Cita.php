<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cita extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre_mascota' => $this->nombre_mascota,
            'nombre_dueno' => $this->nombre_dueno,
            'fecha' => $this->fecha,
          'hora' => $this->hora,
          'sintomas' => $this->sintomas

        ];
    }
}
