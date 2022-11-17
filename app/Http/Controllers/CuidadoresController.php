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
        return view('cuidadores.create', compact('pacientes', 'paciente'));
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

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'rol_id' => intval($request->rol),
            'telefono' => $request->telefono,
            'localidad' => $request->localidad,
            'parentesco' => $request->parentesco,
            'password' => Hash::make($request->password),
        ]);

        $paciente = Paciente::find($request->paciente);
        $paciente->users()->attach($user->id);

        return redirect("/pacientes");
    }

    public function destroy($id)
    {
        //Sacamos al paciente y lo borramos
        User::findOrFail($id)->delete();

        //Redireccionamos a lista pacientes
        return back();
        
    }
}
