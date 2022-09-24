<?php

use Illuminate\Support\Facades\Route;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Telefono;

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
    EJECUTAR LA PRIMERA VEZ PARA CREAR FILAS EN LA BBDD
    $departamento = new Departamento();
    $departamento->nombre = "Departamento 1";
    $departamento->save();

    $emp = new Empleado();
    $emp->nombre = "Juan";
    $emp->departamento_id = 1;
    $emp->save();

    $emp = new Empleado();
    $emp->nombre = "Manuel";
    $emp->departamento_id = 1;
    $emp->save();

    $tlf = new Telefono();
    $tlf->numero = "676543467";
    $tlf->empleado_id = 1;
    $tlf->save();


    OBTENER DEPARTAMENTO 1 Y SUS EMPLEADOS
    Departamento::find(1)->empleados;

    OBTENER EMPLEADO 1 Y SU DEPARTAMENTO
    Empleado::find(1)->departamento;

    OBTENER EMPELADO 1 Y SU TELEFONO
    Empleado::find(1)->telefono;

   */ 



    
});