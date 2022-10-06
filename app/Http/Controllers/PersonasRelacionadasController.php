<?php

namespace App\Http\Controllers;

use App\Models\Personarelacionada;
use Illuminate\Http\Request;

class PersonasRelacionadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos la lista de personas relacionadas
        $personas = Personarelacionada::all();

        //Devolvemos la lista
        return view("personasrelacionadas.index", compact("personas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("personasrelacionadas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([

            "nombre" => "required",
            "apellidos"  => "required",
            "telefono"  => "required",
            "ocupacion" => "required",
            "email" => "required|unique:personarelacionadas",
            "tiporelacion_id"  => "required"

        ]);

        Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "tiporelacion_id" => $request->tiporelacion_id

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personarelacionada  $personarelacionada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Personarelacionada::find($id);
        return view("personarelacionada.show", compact($persona));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personarelacionada  $personarelacionada
     * @return \Illuminate\Http\Response
     */
    public function edit(Personarelacionada $personarelacionada)
    {
        return view("personarelacionada.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personarelacionada  $personarelacionada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $persona = Personarelacionada::findOrFail($id);

        $persona->update($request->all());

        return redirect("/personarelacionada");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personarelacionada  $personarelacionada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Personarelacionada::find($id)->delete();
        return redirect("/personarelacionada");

    }

   
}
