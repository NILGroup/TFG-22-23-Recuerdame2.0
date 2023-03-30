<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sesion;
use App\Models\Residencia;
use App\Models\Situacion;
use App\Models\Estudio;
use App\Models\Genero;
use App\Models\Multimedia;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class PacientesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['asignarPaciente'])->except(['index', 'create','destroy', 'restore']);
    }
    
    /**
     * Obtiene la lista completa de pacientes y se los devuelve a la vista de lista pacientes
     */

    public function index()
    {
        //Sacamos a todos los pacientes de la bd
        $idTerapeuta = Auth::id();
        $pacientes = User::find($idTerapeuta)->pacientes;
        //Redireccionamos a la vista devolviendo la lista de pacientes
        return view("pacientes.index", compact("pacientes"));

        
    }

    /**
     * Devuelve la vista de crear paciente
     */

    public function create()
    {
        $paciente = new Paciente();
        $residencias = Residencia::all()->sortBy("id");
        $situaciones = Situacion::all()->sortBy("id");
        $estudios = Estudio::all()->sortBy("id");
        $generos = Genero::all()->sortBy("id");
        return view("pacientes.create", compact("residencias", "situaciones", "estudios", "generos", "paciente"));
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
            "genero_id" => "required",
            "lugar_nacimiento" => "required",
            "nacionalidad" => "required",
            "fecha_nacimiento" => "required",
            "ocupacion" => "required",
            "residencia_id" => "required",
            "estudio_id" => "required",
            "situacion_id" => "required"
        ]);

        //Almacenamos al paciente en la bd
        $user = User::find(Auth::id());

        $paciente = Paciente::updateOrcreate([
            "nombre" => $request->nombre,
            "apellidos" => $request->apellidos,
            "genero_id" => $request->genero_id,
            "lugar_nacimiento" => $request->lugar_nacimiento,
            "nacionalidad" => $request->nacionalidad,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "ocupacion" => $request->ocupacion,
            "residencia_actual" => $request->residencia_actual,
            "fecha_inscripcion" => $request->fecha_inscripcion,
            "residencia_id" => $request->residencia_id,
            "residencia_custom" => $request->residencia_custom,
            "estudio_id" =>  $request->estudio_id,
            "situacion_id" =>  $request->situacion_id
        ]);


        MultimediasController::savePhoto($request, $paciente);

        $paciente->users()->save($user);
        session()->put('created', "true");
        //Redireccionamos a la vista de lista pacientes
        //return redirect("/pacientes");
        
    }

    /**
     * Obtiene el paciente especificado y lo devuelve a la vista de mostrar paciente
     */

    public function show($id)
    {
        $show = true;
        //Obtenemos al paciente
        $paciente = Paciente::findOrFail($id);
        $residencias = Residencia::all()->sortBy("id");
        $situaciones = Situacion::all()->sortBy("id");
        $estudios = Estudio::all()->sortBy("id");
        $generos = Genero::all()->sortBy("id");
        $personas = $paciente->personasrelacionadas;
        $evaluaciones = $paciente->evaluaciones->sortBy("id");
        $cuidadores = $paciente->users->where('rol_id', 2);

        $fechaAnterior = \Carbon\Carbon::parse($paciente->fecha_inscripcion)->format("Y-m-d h:i:s");
        foreach($evaluaciones as $evaluacion){
            $fechaActual = \Carbon\Carbon::parse($evaluacion->fecha)->addDays(1)->format("Y-m-d h:i:s");
            //$fechas->push([$fechaAnterior, $fechaActual]);
            $sesiones = Sesion::whereBetween("fecha_finalizada", [$fechaAnterior, $fechaActual])->get();
            $evaluacion->numSesiones = count($sesiones);
            $fechaAnterior=$fechaActual;
        }

        if(!is_null($paciente->diagnostico)){
            $diagnostico = $paciente->diagnostico;

            $fechasNF = $paciente->evaluaciones()->pluck("fecha")->toarray();
            array_unshift($fechasNF, $diagnostico->fecha);
            $fechas = array();
            foreach ($fechasNF as $fecha) {
                $fecha = Carbon::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');
                array_push($fechas,$fecha);
            }

            $gds = $paciente->evaluaciones()->pluck("gds")->toarray();
            array_unshift($gds, $diagnostico->gds);

            $mini = $paciente->evaluaciones()->pluck("mental")->toarray();
            array_unshift($mini, $diagnostico->mental);

            $cdr = $paciente->evaluaciones()->pluck("cdr")->toarray();
            array_unshift($cdr, $diagnostico->cdr);
        }
        else{
            $diagnostico = new Diagnostico();
            $fechas = array();
            $gds = array();
            $mini = array();
            $cdr = array();
        }
        return view("pacientes.show", compact("paciente", "residencias", "situaciones", "estudios", "generos", "evaluaciones", "personas", "cuidadores", "show", 'diagnostico', 'fechas', 'gds', 'mini', 'cdr'));

    }

    /**
     * Obtiene al paciente a editar y lo devuelve a la vista de editar paciente
     */

    public function edit(int $id)
    {
        //Sacamos al paciente de la bd
        $paciente = Paciente::findOrFail($id);
        $residencias = Residencia::all()->sortBy("id");
        $situaciones = Situacion::all()->sortBy("id");
        $estudios = Estudio::all()->sortBy("id");
        $generos = Genero::all()->sortBy("id");

        //Devolvemos al paciente a la vista de editar paciente
        return view("pacientes.edit", compact("paciente", "residencias", "situaciones", "estudios", "generos"));
    }

    /**
     * Actualiza al paciente especificado y redirecciona a la lista de pacientes
     */

    public function update(Request $request)
    {
        //Sacamos al paciente de la bd
        $paciente = Paciente::findOrFail($request->id);

        //Actualizamos masivamente los datos del paciente
        $paciente->update($request->all());

        MultimediasController::savePhoto($request, $paciente);
        
        session()->put('created', "true");
        //Redireccionamos a lista pacientes
        //return redirect("/pacientes/$request->id");
        
    }

    /**
     * Elimina al paciente especificado de la base de datos y redirecciona a la lista de pacientes
     */

    public function destroy($id)
    {
        //Sacamos al paciente y lo borramos
        Paciente::findOrFail($id)->delete();
        session()->forget('paciente');
        //Redireccionamos a lista pacientes
        //return redirect("/pacientes");
    }
    public function restore($id) 
    {
        Paciente::where('id', $id)->withTrashed()->restore();
    }

    public function addPacienteToTerapeuta(int $id) {
        $paciente = Paciente::findOrFail($id);
        $users = User::where("rol_id","=",1)->get();

        return view("pacientes.addPacienteToTerapeuta", compact("paciente", "users"));
    }

    public function asignacionTerapeutas(Request $request)
    {
        $paciente = Paciente::find($request->paciente_id);
        $paciente->users()->sync($request->seleccion);
        return redirect("/pacientes");
    }

    public function removePhoto(Request $request){

        $paciente = Paciente::findOrFail($request->id);
        $paciente->multimedia->delete();
        
        return redirect("/pacientes/$paciente->id/editar");

    }

}
