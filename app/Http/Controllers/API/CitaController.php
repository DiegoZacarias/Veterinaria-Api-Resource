<?php

namespace App\Http\Controllers\API;

use App\Cita;
use App\Http\Resources\Cita as CitaResources;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CitaCollection;

class CitaController extends Controller
{

    /*
        STATUS INDEX
        1XX : Informativo
        2XX : Respuesta exitosa
            201 :  Creado
            204: Eliminado
        3XX : Redirección
        4XX : Errores del cliente
        5XX : Errores del servidor
     */

    public function __construct(Cita $cita)
    {
            $this->cita = $cita;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = $this->cita->get();

        return response()->json(

            new CitaCollection(
                $citas
            )

        );


        
        // return response()->json($citas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $cita = Cita::create($request->all());

        return response()->json($cita,201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {

        $cita->delete();

        return response()->json(null,204);
    }
}
