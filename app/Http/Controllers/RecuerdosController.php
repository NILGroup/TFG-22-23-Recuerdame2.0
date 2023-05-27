<?php

namespace App\Http\Controllers;

use App\Models\Recuerdo;
use App\Models\Sesion;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Etiqueta;
use App\Models\Paciente;
use App\Models\Multimedia;
use App\Models\Emocion;
use App\Models\Personarelacionada;
use App\Models\Tiporelacion;
use Carbon\Carbon;
use DateTime;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Psy\Readline\Hoa\Console;

use function PHPUnit\Framework\isNull;

class RecuerdosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role'])->except(['show', 'showByPaciente']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }

    /*
    * Muestra la vista de creación de un recuedo
    */
    public function create()
    {
        $show = false;
        $recuerdo = new Recuerdo();
        $paciente = Paciente::find(Session::get('paciente')['id']);
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $personas = $paciente->personasrelacionadas;
        $tipos = Tiporelacion::all()->sortBy("id");
        $idPaciente = $paciente->id;
        $mostrarFoto = false;
        $persona = new Personarelacionada();
        $recuerdo->apto = true;

        return view("recuerdos.create", compact("idPaciente","mostrarFoto", "persona","estados", "etiquetas", "etapas", "emociones", "categorias", "personas", "tipos", "recuerdo", "personas", "paciente", "show"));
    }

    /*
    * Crea un nuevo recuerdo
    */
    public function store(Request $request)
    {
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            [
                'fecha' => $request->fecha,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'localizacion' => $request->localizacion,
                'etapa_id' => $request->etapa_id,
                'categoria_id' => $request->categoria_id,
                'emocion_id' => $request->emocion_id,
                'estado_id' => $request->estado_id,
                'etiqueta_id' => $request->etiqueta_id,
                'puntuacion' => $request->puntuacion,
                'tipo_custom' => $request->tipo_custom,
                'paciente_id' => $request->paciente_id,
                'apto' => !is_null($request->apto)
            ]
        );
        $recuerdo->multimedias()->detach();
        if (isset($request->mult)) {
            $recuerdo->multimedias()->attach($request->mult);
        }
        MultimediasController::savePhotosWithDescriptions($request, $recuerdo);
        $personas_relacionar = $request->checkPersona; //Array de ids de las personas
        $recuerdo->personas_relacionadas()->detach();
        if (!is_null($personas_relacionar)) {
            foreach ($personas_relacionar as $p_id) {
                $recuerdo->personas_relacionadas()->attach($p_id);
            }
        }
        session()->put('created', "true");
        return redirect("/usuarios/" . $recuerdo->paciente_id . "/recuerdos");
    }

    /*
    * Actualiza un recuerdo existente
    */
    public function update(Request $request)
    {
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            [
                'fecha' => $request->fecha,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'localizacion' => $request->localizacion,
                'etapa_id' => $request->etapa_id,
                'categoria_id' => $request->categoria_id,
                'emocion_id' => $request->emocion_id,
                'estado_id' => $request->estado_id,
                'etiqueta_id' => $request->etiqueta_id,
                'puntuacion' => $request->puntuacion,
                'tipo_custom' => $request->tipo_custom,
                'paciente_id' => $request->paciente_id,
                'apto' => !is_null($request->apto)
            ]
        );
        $recuerdo->multimedias()->detach();
        if (isset($request->mult)) {
            $recuerdo->multimedias()->attach($request->mult);
        }
        MultimediasController::savePhotosWithDescriptions($request, $recuerdo);
        $personas_relacionar = $request->checkPersona; //Array de ids de las personas
        $recuerdo->personas_relacionadas()->detach();
        if (!is_null($personas_relacionar)) {
            foreach ($personas_relacionar as $p_id) {
                $recuerdo->personas_relacionadas()->attach($p_id);
            }
        }
        session()->put('created', "true");
        return redirect("/usuarios/$recuerdo->paciente_id/recuerdos/$recuerdo->id");
    }

    /*
    * Muestra un recuerdo
    */
    public function show($idPaciente, $idRecuerdo)
    {
        $show = true;
        $recuerdo = Recuerdo::find($idRecuerdo);
        $paciente = $recuerdo->paciente;
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $tipos = Tiporelacion::all()->sortBy("id");
        return view("recuerdos.show", compact("recuerdo", "estados", "etiquetas", "etapas", "emociones", "categorias", "paciente", "show", "tipos"));
    }

    /*
    * Muestra la lista de recuerdos del paciente
    */
    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);

        $recuerdos = $paciente->recuerdos;
        //Devolvemos los recuerdos
        return view("recuerdos.showByPaciente", compact("recuerdos", "paciente"));
    }

    /*
    * Devuelve los recuerdos de una sesión
    */
    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->recuerdos;
    }

    /*
    * ¿Función obsoleta? El código al menos es incorrecto
    */
    public function showMultimedia($idRecuerdo)
    {
        return Sesion::find($idRecuerdo)->multimedias;
    }
    
    /*
    * Redirige a la vista de edición de un recuerdo
    */
    public function edit($idP, $idRecuerdo)
    {
        $show = false;

        $recuerdo = Recuerdo::find($idRecuerdo);
        $paciente = $recuerdo->paciente;
        $estados = Estado::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        $etapas = Etapa::all()->sortBy("id");
        $emociones = Emocion::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $personas = $paciente->personasrelacionadas;
        $tipos = Tiporelacion::all()->sortBy("id");
        $idPaciente = $paciente->id;
        $mostrarFoto = false;
        $persona = new Personarelacionada();

        $multimedias = [];

        $sesiones = $paciente->sesiones;

        foreach($sesiones as $s){
            foreach($s->multimedias as $multimedia){

                $existent = true;
                foreach ($multimedias as $mult){
                    if ($mult->id == $multimedia->id){
                        $existent = false;
                    }
                }

                if ($existent){
                    array_push($multimedias, $multimedia);
                }
                
            }
        }

        return view("recuerdos.edit", compact("multimedias", "idPaciente","mostrarFoto", "persona","recuerdo", "estados", "etiquetas", "etapas", "emociones", "categorias", "personas", "tipos", "paciente", "show"));
    }
    
    /*
    * Elimina un recuerdo
    */
    public function destroy($idRecuerdo)
    {
        $recuerdo = Recuerdo::find($idRecuerdo);
        $paciente = $recuerdo->paciente;
        $recuerdo->delete();
    }

    /*
    * Recupera un recuerdo eliminado
    */
    public function restore($idP, $id) 
    {
        Recuerdo::where('id', $id)->withTrashed()->restore();
    }

    /*
    * Devuelve la fecha del recuerdo más antiguo del paciente
    */
    public function oldestMemoryDate($idPaciente)
    {
        $memory = Paciente::find($idPaciente)->recuerdos
            ->orderBy('fecha')
            ->take(1)
            ->get();
        return $memory->fecha;
    }

    /*Como el store pero no redirige a una vista*/
    public function storeNoView(Request $request)
    {
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            [
                'fecha' => $request->fecha,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'localizacion' => $request->localizacion,
                'etapa_id' => $request->etapa_id,
                'categoria_id' => $request->categoria_id,
                'emocion_id' => $request->emocion_id,
                'estado_id' => $request->estado_id,
                'etiqueta_id' => $request->etiqueta_id,
                'puntuacion' => $request->puntuacion,
                'paciente_id' => $request->paciente_id,
                'tipo_custom' => $request->tipo_custom,
                'apto' => $request->apto
            ]
        );

        $personas_relacionar = $request->ids_personas; //Array de ids de las personas
        $recuerdo->personas_relacionadas()->detach();
        if (!is_null($personas_relacionar)) {
            foreach ($personas_relacionar as $p_id) {  
                $recuerdo->personas_relacionadas()->attach($p_id);
                
            }
        }

        $recuerdo->etapa = $recuerdo->etapa->nombre;
        if (is_null($recuerdo->categoria_id)) {
            $recuerdo->categoria = " ";
        } else {
            $recuerdo->categoria = $recuerdo->categoria->nombre;
        }

        if (is_null($recuerdo->estado_id)) {
            $recuerdo->estado = " ";
        } else {
            $recuerdo->estado = $recuerdo->estado->nombre;
        }

        if (is_null($recuerdo->etiqueta_id)) {
            $recuerdo->etiqueta = " ";
        } else {
            $recuerdo->etiqueta = $recuerdo->etiqueta->nombre;
        }
        return $recuerdo;
    }

    /*
    * Devuelve un recuerdo sin redirigir la vista
    */
    public function getNoView(Request $request){
        $recuerdo = Recuerdo::find($request->id);
        $personas = $recuerdo->paciente->personasrelacionadas;
        foreach($personas as $p){
            if($recuerdo->personas_relacionadas->contains($p->id)){
                $p->related = 1;
            }
            else{
                $p->related = 0;
            }
            if($p->tiporelacion_id == 7){
                $p->tiporelacion_id = $p->tipo_custom;
            }
            else{
                $p->tiporelacion_id = $p->tiporelacion->nombre;
            }
        }
        $recuerdo->personasrelacionadas = $personas;    
        return json_encode($recuerdo);
    }

    /*
    * ¿Función obsoleta? Elimina a la persona relacionada del recuerdo en cuestión (su relación)
    */
    public function destroyPersonaRelacionada($idRecuerdo, $idPersona)
    {
        //¿unsetRelation?
        //    Recuerdo::find($idRecuerdo)->personas_relacionadas   destroy($idRecuerdo);
    }
}


