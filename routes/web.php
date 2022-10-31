<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\RecuerdosController;
use App\Http\Controllers\SesionesController;
use App\Http\Controllers\MultimediasController;
use App\Http\Controllers\PersonasRelacionadasController;
use App\Http\Controllers\InformesSesionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Models\Paciente;
use App\Models\Actividad;
use App\Models\Evaluacion;
use App\Models\Estado;
use App\Models\Etapa;
use App\Models\TipoRelacion;
use App\Models\PersonaRelacionada;
use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\Categoria;
use App\Models\Multimedia;
use App\Models\Etiqueta;
use App\Models\Emocion;
use App\Models\Personarelacionada as ModelsPersonarelacionada;
use App\Models\Recuerdo;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/pacientes');
});

Route::resources([
    'recuerdo' => RecuerdosController::class,
    'sesiones' => SesionesController::class,
    'pacientes' => PacientesController::class,
    'multimedias' => MultimediasController::class,
    'personas' => PersonasRelacionadasController::class,
    'calendario' => CalendarioController::class,
    'informesSesion' => InformesSesionController::class,
    'evaluaciones' => EvaluacionController::class
]);

//Registro y login
Auth::routes();



//RUTAS CUSTOMIZADAS CUIDADOR
Route::get('/cuidadores/crear', 'App\Http\Controllers\CuidadoresController@create');
Route::post('/registroCuidador','App\Http\Controllers\CuidadoresController@registroCuidador');

//RUTAS CUSTOMIZADAS SESION
Route::post('/crearSesion', 'App\Http\Controllers\SesionesController@store');
Route::delete('/eliminarSesion/{id}', 'App\Http\Controllers\SesionesController@destroy');
Route::get('/pacientes/{id}/sesiones/{idS}/editar', 'App\Http\Controllers\SesionesController@showEditable');
Route::get('/sesion/showAll', 'App\Http\Controllers\SesionesController@showAll');
Route::get('/pacientes/{id}/sesiones', 'App\Http\Controllers\SesionesController@showByPaciente');
Route::post('/updateAndRecuerdoNuevo','App\Http\Controllers\SesionesController@updateAndRecuerdoNuevo');
Route::post('/updateAndSeleccionarRecuerdos','App\Http\Controllers\SesionesController@updateAndSeleccionarRecuerdos');
Route::get('/pacientes/{id}/asignarTerapeutas', 'App\Http\Controllers\PacientesController@addPacienteToTerapeuta');
Route::post('/asignacionTerapeutas','App\Http\Controllers\PacientesController@asignacionTerapeutas');

//RUTAS CUSTOMIZADAS RECUERDO
Route::get('/pacientes/{id}/recuerdos', 'App\Http\Controllers\RecuerdosController@showByPaciente');
Route::get('/recuerdos/{id}', 'App\Http\Controllers\RecuerdosController@showByPaciente');
Route::delete('/eliminarRecuerdo/{id}', 'App\Http\Controllers\RecuerdosController@destroy');
Route::post('/storeRecuerdoNoView', 'App\Http\Controllers\RecuerdosController@storeNoView');

//RUTAS CUSTOMIZADAS PERSONA RELACIONADA
Route::get('/pacientes/{id}/personas', 'App\Http\Controllers\PersonasRelacionadasController@showByPaciente');
Route::get('/pacientes/{id}/crearPersona', 'App\Http\Controllers\PersonasRelacionadasController@createByPaciente');
Route::post('/storePersonaNoView', 'App\Http\Controllers\PersonasRelacionadasController@storeNoView');

//RUTAS CUSTOMIZADAS CALENDARIO
Route::get('/pacientes/{id}/calendario', 'App\Http\Controllers\CalendarioController@showByPaciente');
Route::get('/mostrarActividades/{id}', 'App\Http\Controllers\CalendarioController@show');
Route::post('/eliminarActividad', 'App\Http\Controllers\CalendarioController@destroy');
Route::post('/modificarActividad', 'App\Http\Controllers\CalendarioController@update');

//RUTAS CUSTOMIZADAS INFORMES SESION
Route::get('/pacientes/{id}/informesSesion', 'App\Http\Controllers\InformesSesionController@showByPaciente');
Route::get('/pacientes/{id}/sesiones/{idS}/generarInforme', 'App\Http\Controllers\InformesSesionController@generarInforme');
Route::get('/pacientes/{id}/sesiones/{idS}/informe', 'App\Http\Controllers\PDFController@verInformeSesion');
Route::get('/pacientes/{id}/sesiones/{idS}/ver', 'App\Http\Controllers\InformesSesionController@show');
Route::post('/cerrarInformeSesion', 'App\Http\Controllers\InformesSesionController@store');
Route::post('/generarPDFInformeSesion', 'App\Http\Controllers\InformesSesionController@generarPDFInformeSesion');

//RUTAS CUSTOMIZADAS EVALUACION
Route::get('/pacientes/{id}/evaluaciones', 'App\Http\Controllers\EvaluacionController@showByPaciente');
Route::get('/pacientes/{id}/evaluaciones/generarInforme', 'App\Http\Controllers\EvaluacionController@generarInforme');
Route::get('/pacientes/{id}/evaluaciones/{idE}/informe', 'App\Http\Controllers\PDFController@verInformeEvaluacion');
Route::get('/pacientes/{id}/evaluaciones/{idE}/editar', 'App\Http\Controllers\EvaluacionController@showEditable');
Route::get('/pacientes/{id}/evaluaciones/{idE}/ver', 'App\Http\Controllers\EvaluacionController@show');
Route::post('/cerrarEvaluacion', 'App\Http\Controllers\EvaluacionController@store');
Route::post('/generarPDFEvaluacion', 'App\Http\Controllers\EvaluacionController@generarPDFInformeEvaluacion');

//RUTAS CUSTOMIZADAS HISTORIAS DE VIDA
Route::get('/pacientes/{id}/historias/generarHistoria', 'App\Http\Controllers\HistoriaController@generarHistoria');
Route::get('/historias/generarLibro', 'App\Http\Controllers\HistoriaController@generarLibroHistoria');
Route::get('/generarPDFHistoria', 'App\Http\Controllers\PDFController@generarPDFHistoria');
   
/*********************************************************
    CREA DATOS EN LA BASE DE DATOS
*********************************************************/
Route::post('/prueba', function () {

    Rol::updateOrcreate(["nombre" => "Terapeuta"]);
    Rol::updateOrcreate(["nombre" => "Cuidador"]);


    Etapa::updateOrcreate(["nombre" => "Infancia"]);
    Etapa::updateOrcreate(["nombre" => "Adolescencia"]);
    Etapa::updateOrcreate(["nombre" => "Adulto joven"]);
    Etapa::updateOrcreate(["nombre" => "Adulto"]);
    Etapa::updateOrcreate(["nombre" => "Adulto Mayor"]);


    Estado::updateOrcreate(["nombre" => "Conservado"]);
    Estado::updateOrcreate(["nombre" => "En riesgo"]);
    Estado::updateOrcreate(["nombre" => "Perdido"]);


    Emocion::updateOrcreate(["nombre" => "Alegría"]);
    Emocion::updateOrcreate(["nombre" => "Nostalgia"]);
    Emocion::updateOrcreate(["nombre" => "Ira"]);
    Emocion::updateOrcreate(["nombre" => "Enfado"]);
    Emocion::updateOrcreate(["nombre" => "Tristeza"]);


    Etiqueta::updateOrcreate(["nombre" => "Positivo"]);
    Etiqueta::updateOrcreate(["nombre" => "Neutro"]);
    Etiqueta::updateOrcreate(["nombre" => "Negativo"]);
 

    Categoria::updateOrcreate(["nombre" => "Familia"]);
    Categoria::updateOrcreate(["nombre" => "Amistad"]);
    Categoria::updateOrcreate(["nombre" => "Hobbies"]);
    Categoria::updateOrcreate(["nombre" => "Trabajo"]);
    Categoria::updateOrcreate(["nombre" => "Política"]);
    Categoria::updateOrcreate(["nombre" => "Estudios"]);
    Categoria::updateOrcreate(["nombre" => "Otro"]);


    Multimedia::updateOrcreate(["nombre" => "multimedia 1", "fichero" => "avatar_hombre.png"]);
    Multimedia::updateOrcreate(["nombre" => "multimedia 2", "fichero" => "avatar_hujer.png"]);


    TipoRelacion::updateOrcreate(["nombre" => "Padre / Madre"]);
    TipoRelacion::updateOrcreate(["nombre" => "Hermano / Hermana"]);
    TipoRelacion::updateOrcreate(["nombre" => "Hijo / Hija"]);
    TipoRelacion::updateOrcreate(["nombre" => "Primo / Prima"]);
    TipoRelacion::updateOrcreate(["nombre" => "Tío / Tía"]);
    TipoRelacion::updateOrcreate(["nombre" => "Amigo / Amiga"]);
    TipoRelacion::updateOrcreate(["nombre" => "Otro"]);


    User::updateOrcreate(['nombre' => "Terapeuta", 'apellidos' => "Uno", 'email' => "terapeuta@gmail.com", 
                        'usuario' => "Terapeuta", 'rol_id' => 1, 'password' => Hash::make("terapeuta") ]);
    User::updateOrcreate(['nombre' => "Cuidador", 'apellidos' => "Uno", 'email' => "cuidador@gmail.com",
                        'usuario' => "cuidador", 'rol_id' => 2, 'password' => Hash::make("cuidador") ]);
    User::updateOrcreate(['nombre' => "Cuidador", 'apellidos' => "Dos", 'email' => "cuidador2@gmail.com",
                        'usuario' => "cuidador2", 'rol_id' => 2, 'password' => Hash::make("cuidador") ]);
    User::updateOrcreate(['nombre' => "Terapeuta", 'apellidos' => "Dos", 'email' => "terapeuta2@gmail.com", 
                        'usuario' => "Terapeuta2", 'rol_id' => 1, 'password' => Hash::make("terapeuta") ]);


    Paciente::updateOrcreate(["nombre" => "Miguel", "apellidos" => "Martinez-Almeida Nistal", "genero" => 'H',
                        "lugar_nacimiento" => "Madrid", "nacionalidad" => "Española", "fecha_nacimiento" => Carbon::create(2001, 7, 30),
                        "tipo_residencia" => "Piso", "residencia_actual" => "secreto", "cuidador_id" => 2 ]);
    Paciente::updateOrcreate(["nombre" => "Cristina", "apellidos" => "Díez Sobrino", "genero" => 'M',
                        "lugar_nacimiento" => "Madrid", "nacionalidad" => "Española", "fecha_nacimiento" => Carbon::create(1999, 1, 21),
                        "tipo_residencia" => "Casa", "residencia_actual" => "secreto","cuidador_id" => 3 ]);


    Personarelacionada::updateOrcreate(["nombre" => "Ignacio", "apellidos" => "Martinez-Almeida", "telefono" => "678765456", 
                        "ocupacion" => "Desconocido", "email" => "igMar@gmail.com", "tiporelacion_id" => 2, "paciente_id" => 1 ]);
    Personarelacionada::updateOrcreate(["nombre" => "Pablo", "apellidos" => "Martinez Gonzalez", "telefono" => "600000000",
                        "ocupacion" => "Estudiante", "email" => "pabMar@gmail.com", "tiporelacion_id" => 4, "paciente_id" => 1 ]);
    Personarelacionada::updateOrcreate(["nombre" => "Eros", "apellidos" => "Guerrero Sosa", "telefono" => "666666666", 
                        "ocupacion" => "Estudiante", "email" => "erGuer@gmail.com", "tiporelacion_id" => 6, "paciente_id" => 2 ]);
    Personarelacionada::updateOrcreate(["nombre" => "Adrián", "apellidos" => "Prieto Campo", "telefono" => "000000000",
                        "ocupacion" => "Estudiante", "email" => "adrPri@gmail.com", "tiporelacion_id" => 7, "paciente_id" => 2 ]);


    Actividad::updateOrcreate(["start" => Carbon::now(), "title" => "Primera terapia", "paciente_id" => 1,
                        "description" => "Primera terapia de evaluación al paciente Miguel", "color" => "#00c7fc" ]);
    Actividad::updateOrcreate(["start" => Carbon::now(), "title" => "Primera terapia", "paciente_id" => 2,
                        "description" => "Primera terapia de evaluación a la paciente Cristina", "color" => "#ff00fb" ]);

                                
    Evaluacion::updateOrcreate(["paciente_id"=> 1, "fecha" => Carbon::create(2022, 9, 30), "gds" => 2, "gds_fecha" => Carbon::create(2022, 9, 30),
                        "mental" => 2, "mental_fecha" => Carbon::create(2022, 9, 30), "cdr"=> 2, "cdr_fecha" => Carbon::create(2022, 9, 30),
                        "nombre_escala" => "escala custom", "escala" => 2, "fecha_escala" => Carbon::create(2022, 10, 30),
                        "diagnostico" => "Empeora poco a poco", "observaciones" => "Ninguna" ]);
    Evaluacion::updateOrcreate(["paciente_id"=> 1, "fecha" => Carbon::create(2022, 10, 30), "gds" => 1, "gds_fecha" => Carbon::create(2022, 10, 30),
                        "mental" => 1, "mental_fecha" => Carbon::create(2022, 10, 30), "cdr"=> 1, "cdr_fecha" => Carbon::create(2022, 10, 30),
                        "nombre_escala" => "nombre cualquiera", "escala" => 1, "fecha_escala" => Carbon::create(2022, 10, 30),
                        "diagnostico" => "Ha empeorado gravemente", "observaciones" => "No reconoce a su familia" ]);
    Evaluacion::updateOrcreate(["paciente_id"=> 2, "fecha" => Carbon::create(2022, 10, 30), "gds" => 5, "gds_fecha" => Carbon::create(2022, 10, 30),
                        "mental" => 5, "mental_fecha" => Carbon::create(2022, 10, 30), "cdr"=> 5, "cdr_fecha" => Carbon::create(2022, 10, 30),
                        "nombre_escala" => "escala custom", "escala" => 5, "fecha_escala" => Carbon::create(2022, 10, 30),
                        "diagnostico" => "Se encuentra en las primeras etapas" ]);


    Sesion::updateOrcreate(["fecha" => Carbon::create(2022, 9, 17), "etapa_id" => 1, "objetivo" => "objetivo 1", 
                        "descripcion" => "descripcion del objetivo", "barreras"=> "muchas", "facilitadores" => "ninguno", 
                        "fecha_finalizada" => Carbon::create(2022, 9, 19), "paciente_id" => 1, "user_id" => 1, 
                        "respuesta" => "ninguna respuesta", "observaciones" => "ninguna observacion" ]);
    Sesion::updateOrcreate(["fecha" => Carbon::create(2022, 9, 22), "etapa_id" => 2, "objetivo" => "objetivo 2",
                        "descripcion" => "descripcion del objetivo numero 2", "paciente_id" => 1, "user_id" => 1 ]);
    Sesion::updateOrcreate(["fecha" => Carbon::create(2022, 10, 31), "etapa_id" => 2, "objetivo" => "Pruebas iniciales",
                        "descripcion" => "Iniciaremos la terapia", "paciente_id" => 2, "user_id" => 4 ]);

    
    Recuerdo::updateOrcreate([ "fecha" => Carbon::create(2019, 9, 10), "nombre" => "Entrada a la universidad",
                        "descripcion" => "Inició su formación en el grado de Ingeniería del Software",
                        "localizacion" => "Facultad de informatica UCM", "etapa_id" => 3, "categoria_id" => 6,
                        "emocion_id" => 3, "estado_id" => 1, "etiqueta_id" => 3, "puntuacion" => 2, "paciente_id" => 1 ]);
    Recuerdo::updateOrcreate([ "fecha" => Carbon::create(2022, 10, 13), "nombre" => "Cena con amigos",
                        "descripcion" => "Cenó en Taco Bell con sus amigos Eros, Adri y Pablo, entre otros.",
                        "localizacion" => "Taco Bell Moncloa", "etapa_id" => 3, "categoria_id" => 3, "emocion_id" => 2,
                        "estado_id" => 1, "etiqueta_id" => 1, "puntuacion" => 10, "paciente_id" => 1 ]);    
    Recuerdo::updateOrcreate([ "fecha" => Carbon::create(2022, 10, 13), "nombre" => "Fiesta en La Sierra",
                        "descripcion" => "Se montó una ``tremenda fiestuqui´´ con sus amigos en una discoteca de La Sierra ",
                        "localizacion" => "Discoteca Recuer-Dame, La Sierra", "etapa_id" => 3, "categoria_id" => 7, "emocion_id" => 1,
                        "estado_id" => 2, "etiqueta_id" => 2, "puntuacion" => 7, "paciente_id" => 2 ]);    
    
    DB::table("multimedia_sesion")->insertOrIgnore([
        ["multimedia_id" => 1, "sesion_id" => 1],
        ["multimedia_id" => 2, "sesion_id" => 1],
        ["multimedia_id" => 1, "sesion_id" => 2],
        ["multimedia_id" => 1, "sesion_id" => 3],
    ]);

    DB::table("personarelacionada_recuerdo")->insertOrIgnore([
        ["personarelacionada_id" => 1, "recuerdo_id" => 1],
        ["personarelacionada_id" => 2, "recuerdo_id" => 1],
        ["personarelacionada_id" => 1, "recuerdo_id" => 2],
        ["personarelacionada_id" => 2, "recuerdo_id" => 2],
        ["personarelacionada_id" => 3, "recuerdo_id" => 2],
        ["personarelacionada_id" => 4, "recuerdo_id" => 2],
        ["personarelacionada_id" => 2, "recuerdo_id" => 3],
        ["personarelacionada_id" => 3, "recuerdo_id" => 3],
        ["personarelacionada_id" => 4, "recuerdo_id" => 3]
    ]);

    DB::table("recuerdo_sesion")->insertOrIgnore([
        ["recuerdo_id" => 1, "sesion_id" => 1],
        ["recuerdo_id" => 2, "sesion_id" => 1],
        ["recuerdo_id" => 1, "sesion_id" => 2],
        ["recuerdo_id" => 2, "sesion_id" => 2],
        ["recuerdo_id" => 3, "sesion_id" => 3]
    ]);

    DB::table("multimedia_recuerdo")->insertOrIgnore([
        ["multimedia_id" => 1, "recuerdo_id" => 1],
        ["multimedia_id" => 2, "recuerdo_id" => 1],
        ["multimedia_id" => 1, "recuerdo_id" => 2],
        ["multimedia_id" => 2, "recuerdo_id" => 2],
        ["multimedia_id" => 1, "recuerdo_id" => 3]
    ]);

    DB::table("paciente_user")->insertOrIgnore([
        ["paciente_id" => 1, "user_id" => 1],
        ["paciente_id" => 1, "user_id" => 4],
        ["paciente_id" => 2, "user_id" => 4]
    ]);


    return "<h1> Se ha llenado la base de datos </h1>";
});
