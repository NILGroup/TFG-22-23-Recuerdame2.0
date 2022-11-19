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
        $this->middleware(['auth', 'role']);
        $this->middleware(['asignarPaciente'])->except(['destroy']);
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

    public function create(int $idPaciente)
    {
        $show = false;
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = new Personarelacionada();
        $paciente = Paciente::find($idPaciente);
        return view("personasrelacionadas.create", compact("idPaciente", "paciente", "tipos", "persona", "show"));
    }

    /**
     * Almacena una nueva personarelacionada en la base de datos
     */

    public function store(Request $request)
    {

        Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "localidad" => $request->localidad,
            "contacto" => $request->contacto,
            "observaciones" => $request->observaciones,
            "tiporelacion_id" => $request->tiporelacion_id,
            "tipo_custom" => $request->tipo_custom,
            "paciente_id" => $request->paciente_id

        ]);
      
        return redirect("/pacientes/$request->paciente_id/personas");

    }

    /*Como el store pero no devuelve a una vista*/
    public function storeNoView(Request $request)
    {
        $persona = Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "localidad" => $request->localidad,
            "contacto" => $request->contacto,
            "observaciones" => $request->observaciones,
            "tiporelacion_id" => $request->tiporelacion_id,
            "tipo_custom" => $request->tipo_custom,
            "paciente_id" => $request->paciente_id

        ]);
        
        $persona->tiporelacion_id = Tiporelacion::find($persona->tiporelacion_id)->nombre;

        return $persona; //falta relacionarlo con el recuerdo
    }
    /**
     * Devuelve una personarelacionada concreta
     */

    public function show($idPaciente, $id)
    {
        $show = true;
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = Personarelacionada::findOrFail($id);
        $idPaciente = $persona->paciente_id;
        return view("personasrelacionadas.show", compact("persona", "tipos", "show", "idPaciente"));
    }


    /**
     * Edita una personarelacionada concreta
     */

    public function edit(int $id)
    {
        $show = false;
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = Personarelacionada::findOrFail($id);
        $idPaciente = $persona->paciente_id;
        return view("personasrelacionadas.edit", compact("persona","tipos", "show", "idPaciente"));
    }

    /**
     * Actualiza una persona relacionada concreta y redirecciona a la lista de personasrelacionadas
     */

    public function update(Request $request)
    {
        $persona = Personarelacionada::findOrFail($request->id);
        $persona->update($request->all());
        return redirect("/pacientes/$persona->paciente->id/personas/$persona->id");
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
