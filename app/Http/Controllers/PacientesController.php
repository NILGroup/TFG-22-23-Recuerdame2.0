<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Sacamos a todos los pacientes de la bd
        $pacientes = Paciente::all();

        //Redireccionamos a la vista devolviendo la lista de pacientes
        return view("pacientes.index", compact("pacientes"));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pacientes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creamos un paciente vacio
        $paciente = new Paciente();

        //Rellenamos al paciente

        $paciente->nombre = $request->nombre;
        $paciente->apellidos = $request->apellidos;
        $paciente->genero = $request->genero;
        $paciente->lugar_nacimiento = $request->lugar_nacimiento;

        //NO ESTOY MUY SEGURO DE SI ESTO FUNCIONA O HAY QUE CONVERTIR LA FECHA
        $paciente->fecha_nacimiento = $request->fecha_nacimiento; 

        $paciente->nacionalidad = $request->nacionalidad;
        $paciente->tipo_residencia = $request->tipo_residencia;
        $paciente->residencia_actual = $request->residencia_actual;

        //Guardamos al paciente
        $paciente->save();


        
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
        //Sacamos al paciente
        $paciente = Paciente::findOrFail($id);

        //Borramos al paciente
        $paciente->delete();

        //Redireccionamos al index
        return redirect("/pacientes");
        
    }
}
