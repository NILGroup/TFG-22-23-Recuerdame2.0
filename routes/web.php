<?php

use Illuminate\Support\Facades\Route;
use App\Models\Paciente;
use App\Models\Actividad;
use App\Models\Evaluacion;
use App\Models\Estado;
use App\Models\Etapa;
use App\Models\Tipo_relacion;
use App\Models\Persona_relacionada;
use Illuminate\Support\Carbon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('prueba/', function () {
   
    /*

----------------------------------------------------------
    CREA DATOS EN LA BASE DE DATOS
----------------------------------------------------------

    $paciente = new Paciente();

    $paciente->nombre = "Miguel";
    $paciente->apellidos = "Martinez-Almeida Nistal";
    $paciente->genero = 'H';
    $paciente->lugar_nacimiento = "Madrid";
    $paciente->nacionalidad = "Español";
    $paciente->fecha_nacimiento = Carbon::create(2001, 7, 30);
    $paciente->tipo_residencia = "Piso";
    $paciente->residencia_actual = "secreto";

    $paciente->save();

    $actividad = new Actividad();

    $actividad->start = Carbon::now();
    $actividad->title = "Primera terapia";
    $actividad->description = "Primera terapia de evaluación al paciente Miguel";
    $actividad->paciente_id = 1;
    $actividad->color = "rojo";

    $actividad->save();

    $actividad = new Actividad();

    $actividad->start = Carbon::now();
    $actividad->title = "Segunda terapia";
    $actividad->description = "Segunda terapia de evaluación al paciente Miguel";
    $actividad->paciente_id = 1;
    $actividad->color = "amarillo";

    $actividad->save();

    $ev = new Evaluacion();

    $ev->paciente_id = 1;
    $ev->fecha = Carbon::now();
    $ev->gds = 2;
    $ev->gds_fecha = Carbon::now();
    $ev->mental  = 2;
    $ev->mental_fecha = Carbon::now();
    $ev->cdr  = 2;
    $ev->cdr_fecha = Carbon::now();
    $ev->diagnostico  = 2;
    $ev->observaciones  = 2;
    $ev->nombre_escala  = "otro nombre cualquiera";
    $ev->escala  = 2;
    $ev->fecha_escala = Carbon::now();
    $ev->save();

    $ev = new Evaluacion();

    $ev->paciente_id = 1;
    $ev->fecha = Carbon::now();
    $ev->gds = 1;
    $ev->gds_fecha = Carbon::now();
    $ev->mental  = 1;
    $ev->mental_fecha = Carbon::now();
    $ev->cdr  = 1;
    $ev->cdr_fecha = Carbon::now();
    $ev->diagnostico  = 1;
    $ev->observaciones  = 1;
    $ev->nombre_escala  = "nombre cualquiera";
    $ev->escala  = 1;
    $ev->fecha_escala = Carbon::now();
    $ev->save();

    $e = Estado::create(["nombre" => "estado 1"]);
    Etapa::create(["nombre" => "etapa 1"]);

    Tipo_relacion::create(["nombre" => "hermanos"]);

    Persona_relacionada::create([
        "nombre" => "Ignacio",
        "apellidos" => "Martinez-Almeida",
        "telefono" => "678765456",
        "ocupacion" => "Desconocido",
        "email" => "Email desconocido",
        "tipo_relacion_id" => 1
    ]);
    
    */

    
});