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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->middleware('auth');
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
        return view("recuerdos.create", compact("estados","etiquetas","etapas","emociones","categorias", "personas","tipos", "recuerdo", "personas", "paciente", "show"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if(!is_null($request->file)){
        $imagenes = $request->file('file')->store('public/img');

        $url = Storage::url($imagenes);

        Multimedia::create([
            'nombre' => $url,
            'fichero' => $url
        ]);
        }

        //Ahora que tenemos creado el recuerdo
        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'nombre' => $request->nombre,
             'descripcion' => $request->descripcion,
             'localizacion' => $request->localizacion,
             'etapa_id' => $request->etapa_id,
             'categoria_id' => $request->categoria_id,
             'emocion_id' => $request->emocion_id,
             'estado_id' => $request->estado_id,
             'etiqueta_id' => $request->etiqueta_id,
             'puntuacion' => $request->puntuacion,
             'paciente_id' => $request->paciente_id]
        );
        
        $personas_relacionar = $request->checkPersona; //Array de ids de las personas
        if(!is_null($personas_relacionar)){
            foreach ($personas_relacionar as $p_id) {
                $recuerdo->personas_relacionadas()->attach($p_id);
            }
        }

        return self::showByPaciente($recuerdo->paciente_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function show($idRecuerdo)
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
        return view("recuerdos.show", compact("recuerdo","estados","etiquetas","etapas","emociones","categorias", "paciente", "show"));
    }

    public function showByPaciente($idPaciente)
    {
        $paciente =Paciente::find($idPaciente);
        if(is_null($paciente)) return "ID de paciente no encontrada"; //ESTUDIAR SI SOBRA

        $recuerdos = $paciente->recuerdos;
        //Devolvemos los recuerdos
        return view("recuerdos.showByPaciente", compact("recuerdos"));
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
    public function edit($idRecuerdo)
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
        return view("recuerdos.edit", compact("recuerdo","estados","etiquetas","etapas","emociones","categorias", "personas", "tipos","paciente", "show"));
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
     * Elimina el recuerdo en cuesti??n
     *
     * @param  \App\Models\Recuerdo  $recuerdo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRecuerdo)
    {
        $recuerdo = Recuerdo::find($idRecuerdo); //busca el recuerdo en s??
        if(!is_null($recuerdo)){
            $idPaciente = $recuerdo->paciente_id; //accede a la id del paciente
            Recuerdo::destroy($idRecuerdo); //elimina el recuerdo
            return redirect("/pacientes/$idPaciente/recuerdos/");
        }else{
            return redirect("/");
        }


    }

    //Elimina a la persona relacionada del recuerdo en cuesti??n (su relaci??n)
    public function destroyPersonaRelacionada($idRecuerdo, $idPersona)
    {
        //??unsetRelation?
    //    Recuerdo::find($idRecuerdo)->personas_relacionadas   destroy($idRecuerdo);
    }

    //Devuelve la fecha del recuerdo m??s antiguo del paciente
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
            ['fecha' => $request->fecha,
             'nombre' => $request->nombre,
             'descripcion' => $request->descripcion,
             'localizacion' => $request->localizacion,
             'etapa_id' => $request->etapa_id,
             'categoria_id' => $request->categoria_id,
             'emocion_id' => $request->emocion_id,
             'estado_id' => $request->estado_id,
             'etiqueta_id' => $request->etiqueta_id,
             'puntuacion' => $request->puntuacion,
             'paciente_id' => $request->paciente_id]
        );

        $recuerdo->etapa = $recuerdo->etapa->nombre;
        if(is_null($recuerdo->categoria_id)){
            $recuerdo->categoria = " ";
        }
        else{
            $recuerdo->categoria = $recuerdo->categoria->nombre;
        }

        if(is_null($recuerdo->estado_id)){
            $recuerdo->estado = " ";
        }
        else{
            $recuerdo->estado = $recuerdo->estado->nombre;
        }

        if(is_null($recuerdo->etiqueta_id)){
            $recuerdo->etiqueta = " ";
        }
        else{
            $recuerdo->etiqueta = $recuerdo->etiqueta->nombre;
        }
        return $recuerdo;
    }
}
