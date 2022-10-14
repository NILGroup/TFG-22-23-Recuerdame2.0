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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $estados = Estado::all();
        $etiquetas = Etiqueta::all();
        $etapas = Etapa::all();
        $emociones = Emocion::all();
        $categorias = Categoria::all();
        return view("recuerdos.create", compact("estados","etiquetas","etapas","emociones","categorias"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'image|max:2048'
        ]);

        if(!is_null($request->file)){
        $imagenes = $request->file('file')->store('public/img');

        $url = Storage::url($imagenes);

        Multimedia::create([
            'nombre' => $url,
            'fichero' => $url
        ]);
        }

        $recuerdo = Recuerdo::updateOrCreate(
            ['id' => $request->id],
            ['fecha' => $request->fecha,
             'nombre' => $request->nombre,
             'descripcion' => $request->descripcion,
             'etapa_id' => $request->etapa_id,
             'categoria_id' => $request->categoria_id,
             'emocion_id' => $request->emocion_id,
             'estado_id' => $request->estado_id,
             'etiqueta_id' => $request->etiqueta_id,
             'puntuacion' => $request->puntuacion,
             'paciente_id' => $request->paciente_id]
        );
  
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
        $recuerdo = Recuerdo::find($idRecuerdo);
        $estado = Estado::find($recuerdo->estado_id);
        $etiqueta = Etiqueta::find($recuerdo->etiqueta_id);
        $etapa = Etapa::find($recuerdo->etapa_id);
        $emocion = Emocion::find($recuerdo->emocion_id);
        $categoria = Categoria::find($recuerdo->categoria_id);
        return view("recuerdos.show", compact("recuerdo","estado","etiqueta","etapa","emocion","categoria"));
    }

    public function showByPaciente($idPaciente)
    {
        $paciente =Paciente::find($idPaciente);
        if(is_null($paciente)) return "ID de paciente no encontrada"; //ESTUDIAR SI SOBRA

        $recuerdos = $paciente->recuerdos;
        foreach ($recuerdos as $r) {
                $r->etapa_id = Etapa::find($r->etapa_id)->nombre;
                
                $categoria = Categoria::find($r->categoria_id);
                $estado = Estado::find($r->estado_id);
                $etiqueta =  Etiqueta::find($r->etiqueta_id);
                $r->categoria_id = isNull($categoria)?"Sin categoría":$categoria->nombre;
                $r->estado_id = isNull($estado)?"Sin estado":$estado->nombre;
                $r->etiqueta_id = isNull($etiqueta)?"Sin etiqueta":$etiqueta->nombre;
            }
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
        $recuerdo = Recuerdo::find($idRecuerdo);
        $estado = Estado::find($recuerdo->estado_id);
        $etiqueta = Etiqueta::find($recuerdo->etiqueta_id);
        $etapa = Etapa::find($recuerdo->etapa_id);
        $emocion = Emocion::find($recuerdo->emocion_id);
        $categoria = Categoria::find($recuerdo->categoria_id);
        return view("recuerdos.edit", compact("recuerdo","estado","etiqueta","etapa","emocion","categoria"));
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
        if(!isNull($recuerdo)){
            $idPaciente = $recuerdo->paciente_id; //accede a la id del paciente
            Recuerdo::destroy($idRecuerdo); //elimina el recuerdo
            return self::showByPaciente($idPaciente);
        }else{
            return "Sin recuerdo";
        }


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

    //Crear un nuevo recuerdo, asignarlo a la sesión y redireccionar a editar esa sesión. Se llama desde sesiones.updateAndRecuerdoNuevo
    public function crearAndVolverEditar(){

    }

    //Seleccionar los recuerdos de esa sesión entre los existente y redireccionar a editar la sesión. Se llama desde sesiones.updateAndSeleccionarRecuerdos
    public function agregarAndVolverEditar(){

    }
}
