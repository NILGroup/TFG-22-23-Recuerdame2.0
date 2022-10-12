<?php

namespace App\Http\Controllers;

use App\Models\Personarelacionada;
use App\Models\Paciente;
use App\Models\Tiporelacion;
use Illuminate\Http\Request;

class PersonasRelacionadasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Obtiene al paciente y la lista de sus personas relacionadas. Redirecciona a lista personasrelacionadas
     * de un paciente pasandole la lista
     */


    public function showByPaciente(int $idPaciente){

        $paciente = Paciente::findOrFail($idPaciente);
        $personas = $paciente->personasrelacionadas;
     
        return view("personasrelacionadas.showByPaciente", compact("paciente", "personas"));
    }


    /**
     * Redirecciona a la vista de crear personarelacionada pasando al paciente concreto al que queremos añadirla
     */

    public function createByPaciente(int $idPaciente)
    {
        $tipos = Tiporelacion::all();
        return view("personasrelacionadas.create", compact("idPaciente", "tipos"));
    }

    /**
     * Almacena una nueva personarelacionada en la base de datos
     */

    public function store(Request $request)
    {

        /*
        $validate = $request->validate([

            "nombre" => "required",
            "apellidos"  => "required",
            "telefono"  => "required",
            "ocupacion" => "required",
            "email" => "required|unique:personarelacionadas",
            "tiporelacion_id"  => "required",
            "paciente_id" => "required"

        ]);*/

        Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "tiporelacion_id" => $request->tiporelacion_id,
            "paciente_id" => $request->paciente_id

        ]);
      
        return redirect("/pacientes/$request->paciente_id/personas");

    }

    /**
     * Devuelve una personarelacionada concreta
     */

    public function show(int $id)
    {
        $persona = Personarelacionada::findOrFail($id);
        return view("personasrelacionadas.show", compact("persona"));
    }


    /**
     * Edita una personarelacionada concreta
     */

    public function edit(int $id)
    {
        $persona = Personarelacionada::findOrFail($id);
        return view("personasrelacionadas.edit", compact("persona"));
    }

    /**
     * Actualiza una persona relacionada concreta y redirecciona a la lista de personasrelacionadas
     */

    public function update(Request $request, int $id)
    {
        
        $persona = Personarelacionada::findOrFail($id);
        $persona->update($request->all());

        return redirect("/pacientes/$id/personas");


    }

    /**
     * Elimina una persona relacionada concreta
     */

    public function destroy(int $id)
    {
        
        $persona = Personarelacionada::findOrFail($id);
        $paciente = $persona->paciente;
        $persona->delete();

        return redirect("/pacientes/$paciente->id/personas");

    }

   
}
