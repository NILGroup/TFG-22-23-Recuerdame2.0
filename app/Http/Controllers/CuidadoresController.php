<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class CuidadoresController extends Controller
{
    
    public function create(){
        $pacientes = Paciente::whereNull('cuidador_id')->get();
        return view('cuidadores.create', compact('pacientes'));
    }

    protected function registroCuidador(Request $request)
    {

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'rol_id' => intval($request->rol),
            'password' => Hash::make($request->password),
        ]);

        $paciente = Paciente::find($request->paciente);
        $paciente->cuidador_id = $user->id;
        $paciente->save();

        return redirect("/pacientes");
    }


}
