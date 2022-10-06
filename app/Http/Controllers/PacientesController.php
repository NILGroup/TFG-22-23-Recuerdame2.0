<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    /**
     * Obtiene la lista completa de pacientes y se los devuelve a la vista de lista pacientes
     */

    public function index()
    {

        //Sacamos a todos los pacientes de la bd
        $pacientes = Paciente::all();

        //Redireccionamos a la vista devolviendo la lista de pacientes
        return view("pacientes.index", compact("pacientes"));

        
    }

    /**
     * Devuelve la vista de crear paciente
     */

    public function create()
    {
        return view("pacientes.create");
    }

    /**
     * Almacena un paciente en la base de datos y redireccionamos a la lista de pacientes
     */

    public function store(Request $request)
    {

        //Se valida la request
        $validate = $request->validate([

            "nombre" => "required",
            "apellidos" => "required",
            "genero" => "required",
            "lugar_nacimiento" => "required",
            "nacionalidad" => "required",
            "fecha_nacimiento" => "required",
            "tipo_residencia" => "required",
            "residencia_actual" => "required"

        ]);

        //Almacenamos al paciente en la bd
        Paciente::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "genero" => $request->genero,
            "lugar_nacimiento" => $request->lugar_nacimiento,
            "nacionalidad" => $request->nacionalidad,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "tipo_residencia" => $request->tipo_residencia,
            "residencia_actual" => $request->residencia_actual

        ]);

        //Redireccionamos a la vista de lista pacientes
        return redirect("/pacientes");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        //Sacamos al paciente
        $paciente = Paciente::findOrFail($id);

        //Devolvemos al paciente a la vista de mostrar
        return view("pacientes.show", compact("paciente"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Sacamos al paciente de la bd
        $paciente = Paciente::findOrFail($id);

        //Devolvemos al paciente a la vista de editar
        return view("pacientes.edit", compact("paciente"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Sacamos al paciente de la bd
        $paciente = Paciente::findOrFail($id);

        //Actualizamos masivamente los datos del paciente
        $paciente->update($request->all());

        //Redireccionamos al index
        return redirect("/pacientes");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Sacamos al paciente y lo borramos
        Paciente::findOrFail($id)->delete();

        //Redireccionamos al index
        return redirect("/pacientes");
        
    }
}
