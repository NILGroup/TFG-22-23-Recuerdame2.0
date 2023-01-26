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
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class RecuerdosController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        return view("recuerdos.create", compact("idPaciente","mostrarFoto", "persona","estados", "etiquetas", "etapas", "emociones", "categorias", "personas", "tipos", "recuerdo", "personas", "paciente", "show"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        //Ahora que tenemos creado el recuerdo
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
                'paciente_id' => $request->paciente_id
            ]
        );

        


        if ($request->has("file")) { //EN CASO DE MULTIMEDIA
            $name = [];
            $original_name = [];
            foreach ($request->file('file') as $key => $value) {
                $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path() . '/storage/img';
                $value->move($destinationPath, $image);
                $name[] = $image;
                $original_name[] = $value->getClientOriginalName();
                $multimedia = Multimedia::create([
                    'nombre' => $image,
                    'fichero' => '/storage/img/' . $image
                ]);

                $recuerdo->multimedias()->attach($multimedia->id);
            }
        }



        $personas_relacionar = $request->checkPersona; //Array de ids de las personas
        if (!is_null($personas_relacionar)) {
            foreach ($personas_relacionar as $p_id) {
                $recuerdo->personas_relacionadas()->attach($p_id);
            }
        }

        //Array de las ID de las imagenes a eliminar del recuerdo
       if(!$request->media.isNull()) {
        $recuerdo->multimedias()->detach($request->media);
       }
       
        
        return self::showByPaciente($recuerdo->paciente_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
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

    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);
        if (is_null($paciente)) return "ID de paciente no encontrada"; //ESTUDIAR SI SOBRA

        $recuerdos = $paciente->recuerdos;
        //Devolvemos los recuerdos
        return view("recuerdos.showByPaciente", compact("recuerdos", "paciente"));
    }

    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->recuerdos;
    }

    public function showMultimedia($idRecuerdo)
    {
        return Sesion::find($idRecuerdo)->multimedias;
    }
    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
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
        return view("recuerdos.edit", compact("idPaciente","mostrarFoto", "persona","recuerdo", "estados", "etiquetas", "etapas", "emociones", "categorias", "personas", "tipos", "paciente", "show"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recuerdo $recuerdo)
    {
        //
    }

    /**
     * Elimina el recuerdo en cuestión
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRecuerdo)
    {
        $recuerdo = Recuerdo::find($idRecuerdo); //busca el recuerdo en sí
        $paciente = $recuerdo->paciente;
        $recuerdo->delete();
        return redirect("/pacientes/$paciente->id/recuerdos/");
    }

    //Elimina a la persona relacionada del recuerdo en cuestión (su relación)
    public function destroyPersonaRelacionada($idRecuerdo, $idPersona)
    {
        //¿unsetRelation?
        //    Recuerdo::find($idRecuerdo)->personas_relacionadas   destroy($idRecuerdo);
    }

    //Devuelve la fecha del recuerdo más antiguo del paciente
    public function oldestMemoryDate($idPaciente)
    {
        $memory = Paciente::find($idPaciente)->recuerdos
            ->orderBy('fecha')
            ->take(1)
            ->get();
        return $memory->fecha;
    }

    /*Como el store pero no devuelve a una vista*/
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
                'paciente_id' => $request->paciente_id
            ]
        );

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
}
