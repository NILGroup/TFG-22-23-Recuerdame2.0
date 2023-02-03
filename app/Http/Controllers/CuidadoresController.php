<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class CuidadoresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
    }
    public function create($idP){
        $pacientes = Auth::User()->pacientes;
        $paciente = Paciente::find($idP);
        $cuidador = new User();
        return view('cuidadores.create', compact('pacientes', 'paciente', 'cuidador'));
    }

    public function show($idP, $id)
    {
        $pacientes = Auth::User()->pacientes;
        $paciente = Paciente::find($idP);
        $cuidador = User::find($id);
        return view('cuidadores.show', compact('pacientes', 'paciente', 'cuidador'));
    }

    public function edit($idP, $id){
        $pacientes = Auth::User()->pacientes;
        $paciente = Paciente::find($idP);
        $cuidador = User::find($id);
        return view('cuidadores.edit', compact('pacientes', 'paciente', 'cuidador'));
    }

    public function showByPaciente(int $idPaciente){

        $paciente = Paciente::findOrFail($idPaciente);
        $cuidadores = $paciente->users->where('rol_id', 2);
     
        return view("cuidadores.showByPaciente", compact("paciente", "cuidadores"));
    }

    protected function registroCuidador(Request $request)
    {

        $request->validate([
            'telefono'=> 'numeric|digits:9'
        ]);
        
        $user = User::updateOrCreate(
            ['id' => $request->id],
            ['nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'rol_id' => intval($request->rol),
            'telefono' => $request->telefono,
            'localidad' => $request->localidad,
            'parentesco' => $request->parentesco,
            'password' => Hash::make($request->password),
        ]);

        $paciente = Paciente::find($request->paciente);
        $paciente->users()->attach($user->id);
        session()->put('created', "true");

        return redirect("/pacientes/$paciente->id/cuidadores");
    }

    public function destroy($id)
    {
        //Sacamos al paciente y lo borramos
        User::findOrFail($id)->delete();

        //Redireccionamos a lista pacientes
        return back();
    }
}
