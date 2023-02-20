<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $mostrarFoto = false;
        return view('cuidadores.create', compact('mostrarFoto','pacientes', 'paciente', 'cuidador'));
    }

    public function show($idP, $id)
    {
        $pacientes = Auth::User()->pacientes;
        $paciente = Paciente::find($idP);
        $cuidador = User::find($id);
        $mostrarFoto = true;
        return view('cuidadores.show', compact('mostrarFoto','pacientes', 'paciente', 'cuidador'));
    }

    public function edit($idP, $id){
        $pacientes = Auth::User()->pacientes;
        $paciente = Paciente::find($idP);
        $cuidador = User::find($id);
        $mostrarFoto = true;
        return view('cuidadores.edit', compact('mostrarFoto','pacientes', 'paciente', 'cuidador'));
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
            'password' => Hash::make($request->password)
        ]);

        $paciente = Paciente::find($request->paciente);

        if (!$paciente->users->contains($user->id))
            $paciente->users()->attach($user->id);

       
        if ($request->has("file")) {
            $user->multimedia()->delete();
        }
        MultimediasController::savePhoto($request, $user);

        session()->put('created', "true");

        return redirect("/pacientes/$paciente->id/cuidadores");
    }

    public function update(Request $request)
    {
        //Sacamos al paciente de la bd
        $cuidador = User::findOrFail($request->id);

        //Actualizamos masivamente los datos del paciente
        $cuidador->update($request->all());
        $cuidador->update(['password' => Hash::make($request->password)]);

        //MultimediasController::savePhoto($request, $cuidador);
        
        session()->put('created', "true");
        //Redireccionamos a lista pacientes
        //return redirect("/pacientes/$request->id");
        $id = Session::get('paciente')['id'];
        return redirect("/pacientes/$id/cuidadores/$cuidador->id");
        
    }

    public function destroy($id)
    {
        //Sacamos al paciente y lo borramos
        User::findOrFail($id)->delete();

        //Redireccionamos a lista pacientes
        //return back();
    }

    //sirve para chekear si el cuidador ya ha sido registrado
    public function repeatedCuidador(Request $request){
        $email = $request->email;
        $encontrado = User::where('email', $email)->first();
        /*info($email);
        info("hey");
        if($encontrado == false){
            info("false");
        }else{
            info("true");
        }*/
        return User::where('email', $email)->first();
    }


}
