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
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
        $this->middleware(['viendoCuidador'])->only(['show', 'edit']);
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
        $tID = Auth::user()->id;
        $terapeuta = User::find(Auth::user()->id);
        $cuidadoresTerapeuta = User::where('rol_id', "2")->get();
        /*
        //TO-DO mostrar solo los cuidadores del terapeuta y añadir una forma de asignar el resto
        //Obtiene todos los cuidadores relacionados a ese terapeuta
        //Incluyendo los de pacientes que él no ha creado pero le han sido asignados.
        $cuidadoresTerapeuta = User::whereHas('pacientes', function($query) use ($tID) {
            $query->whereHas('users', function($query) use ($tID) {
                $query->where('users.id', $tID);
            });
        })->where('rol_id', "2")->get();
        */
        return view("cuidadores.showByPaciente", compact("paciente", "cuidadores", "cuidadoresTerapeuta"));
    }

    protected function registroCuidador(Request $request)
    {
       
        $user = User::updateOrCreate(
            ['id' => $request->id],
            ['nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'rol_id' => intval($request->rol),
            'telefono' => $request->telefono,
            'localidad' => $request->localidad,
            'parentesco' => $request->parentesco,
            'ocupacion' => $request->ocupacion,
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

        return redirect("/usuarios/$paciente->id/cuidadores");
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
        //return redirect("/usuarios/$request->id");
        $id = Session::get('paciente')['id'];
        return redirect("/usuarios/$id/cuidadores/$cuidador->id");
        
    }

    public function destroy($id)
    {
        $cuidador = User::find($id);
        $paciente = Paciente::find(session()->get('paciente')['id']);
        $paciente->users()->detach($cuidador);
    }

    public function destroy_no_view(Request $request){
        $borrar = User::findOrFail($request->id);
        $permanece = User::findOrFail($request->idCurrent);
        $permanece->multimedia()->delete();
        $multimedia = $borrar->multimedia;
        if (isset($multimedia)){
            $multimedia->user_id = $request->idCurrent;
            $multimedia->save();
        }
        return User::findOrFail($request->id)->delete();
    }

    public function restore($idP, $id) 
    {
        $paciente = Paciente::find($idP);
        $cuidador = User::find($id);
        $paciente->users()->attach($cuidador);
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

    public function removePhoto(Request $request){
        $cuidador = User::findOrFail($request->id);
        $cuidador->multimedia->delete();
        $id = Session::get('paciente')['id'];

        return redirect("/usuarios/$id/cuidadores/$cuidador->id/editar");
    }

    public function reasignarCuidadores(Request $request){
        $paciente = Paciente::find($request->id);
        $cuidadoresPaciente = $paciente->users()->where('rol_id', 2)->get();
        info($cuidadoresPaciente);
        $paciente->users()->detach($cuidadoresPaciente);
        $cuidadores = $request->checkCuidador;
        $paciente->users()->attach($cuidadores);
    }
    
}
