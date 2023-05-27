<?php

namespace App\Http\Controllers;

use App\Models\Personarelacionada;
use App\Models\Paciente;
use App\Models\Tiporelacion;
use Illuminate\Http\Request;
use App\Models\Multimedia;

class PersonasRelacionadasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role'])->except(['show']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }

    /*
    * Obtiene al paciente y la lista de sus personas relacionadas. Redirecciona a lista personasrelacionadas
    * de un paciente pasandole la lista
    */
    public function showByPaciente(int $idPaciente){

        $paciente = Paciente::findOrFail($idPaciente);
        $personas = $paciente->personasrelacionadas;
     
        return view("personasrelacionadas.showByPaciente", compact("paciente", "personas"));
    }

    /*
    * Redirecciona a la vista de crear personarelacionada pasando al paciente concreto al que queremos añadirla
    */
    public function create(int $idPaciente)
    {
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = new Personarelacionada();
        $paciente = Paciente::find($idPaciente);
        $mostrarFoto = false;
        return view("personasrelacionadas.create", compact('mostrarFoto',"idPaciente", "paciente", "tipos", "persona"));
    }

    /**
    * Almacena una nueva personarelacionada en la base de datos
    */
    public function store(Request $request)
    {
        $contacto = false;
        if (isset($request->contacto)){
            $contacto = true;
            Personarelacionada::where('contacto', '=', true)->update(["contacto" => false]);
        }

        $persona = Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "localidad" => $request->localidad,
            "contacto" => $contacto,
            "observaciones" => $request->observaciones,
            "tiporelacion_id" => $request->tiporelacion_id,
            "tipo_custom" => $request->tipo_custom,
            "paciente_id" => $request->paciente_id

        ]);

        MultimediasController::savePhoto($request, $persona);

        session()->put('created', "true");
    }

    /*Como el store pero no devuelve a una vista*/
    public function storeNoView(Request $request)
    {
        $contacto = false;
        if (isset($request->contacto)){
            $contacto = true;
            Personarelacionada::where('contacto', '=', true)->update(["contacto" => false]);
        }
        
        $persona = Personarelacionada::create([

            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "telefono" => $request->telefono,
            "ocupacion" => $request->ocupacion,
            "email" => $request->email,
            "localidad" => $request->localidad,
            "contacto" => $contacto,
            "observaciones" => $request->observaciones,
            "tiporelacion_id" => $request->tiporelacion_id,
            "tipo_custom" => $request->tipo_custom,
            "paciente_id" => $request->paciente_id

        ]);
        
        $persona->tiporelacion_id = Tiporelacion::find($persona->tiporelacion_id)->nombre;

        return $persona; //falta relacionarlo con el recuerdo
    }

    /*
    * Devuelve una personarelacionada concreta
    */
    public function show($idPaciente, $id)
    {
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = Personarelacionada::findOrFail($id);
        $idPaciente = $persona->paciente_id;
        $mostrarFoto = true;
        return view("personasrelacionadas.show", compact("mostrarFoto","persona", "tipos", "idPaciente"));
    }


    /*
    * Edita una personarelacionada concreta
    */
    public function edit($idPaciente, $id)
    {
        $tipos = Tiporelacion::all()->sortBy("id");
        $persona = Personarelacionada::findOrFail($id);
        $idPaciente = $persona->paciente_id;
        $mostrarFoto = true;
        return view("personasrelacionadas.edit", compact("mostrarFoto","persona","tipos", "idPaciente"));
    }

    /*
    * Actualiza una persona relacionada concreta y redirecciona a la lista de personasrelacionadas
    */
    public function update(Request $request)
    {
        $persona = Personarelacionada::findOrFail($request->id);
        $contacto = false;
        if (isset($request->contacto)){
            $contacto = true;
            Personarelacionada::where('contacto', '=', true)->update(["contacto" => false]);
        }
        $request->merge(['contacto' => $contacto]);
        $persona->update($request->all());

        MultimediasController::savePhoto($request, $persona);
        session()->put('created', "true");

        return redirect("/usuarios/$persona->paciente_id/personas/$persona->id");
    }

    /*
    * Elimina una persona relacionada concreta
    */
    public function destroy(int $id)
    {
        $persona = Personarelacionada::findOrFail($id);
        $persona->delete();
    }

    /*
    * Deshace la eliminación de una persona relacionada concreta
    */
    public function restore($idP, $id) 
    {
        Personarelacionada::where('id', $id)->withTrashed()->restore();
    }
    
    /*
    * Elimina la foto de una persona relacionada concreta
    */
    public function removePhoto(Request $request){
        $persona = Personarelacionada::findOrFail($request->id);
        $persona->multimedia->delete();
        return redirect("/usuarios/$persona->paciente_id/personas/$persona->id/editar");
    }
}
