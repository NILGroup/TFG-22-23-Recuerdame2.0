<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
//throw new \Exception(Text);
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $registrado = false;
        return view("usuarios.login", compact("registrado"));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = new Usuario();

        $usuario->nombre = "";
        $usuario->apellidos = "";
        $usuario->usuario = "";
        $usuario->email = "";
        $usuario->password = "";
        $usuario->password2 = "";

        return view("usuarios.registro", compact("usuario"));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|unique:usuarios|email:rfc,dns',
            'usuario' => 'required|unique:usuarios',
            'password' => 'required',
            'password2' => 'required|same:password',
            //'rol' => 'required',
        ]);
        $usuario = Usuario::updateOrCreate(
            ['id' => $request->id],
            ['nombre' => $request->nombre,
             'apellidos' => $request->apellidos,
             'usuario' => $request->usuario,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'rol' => "Terapeuta"]
        );

        $usuario->save();
        return $usuario->id;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Usuario::findOrFail($id);
    }

    public function showByRol($rol)
    {
        //
        return Usuario::where('rol', $rol);
    }

    public function showTherapists($id)
    {
        //
        return Usuario::where(['rol', 'TERAPEUTA'],['id','<>',$id]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {

        return "Editando usuario";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
        $usuario = Usuario::find($usuario->id);
        $usuario->nombre = $usuario->nombre;
        $usuario->apellidos = $usuario->apellidos;
        $usuario->email = $usuario->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = $usuario->rol;
        $usuario->save();
        return "Editando usuario";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function loguear(Request $request)
    {
        $usuarios = Usuario::where('email', $request->usuario)->orWhere('usuario', $request->usuario)->get()->toArray();
        
        $validated = Validator::make(
            ['usuarios' => $usuarios],
            ['usuarios' => 'array|size:1'],
            ['size' => 'Usuario o contraseña incorrectos'],
        )->validate();

        $usuario = Usuario::find($usuarios[0]['id']);
        $validated = Validator::make(
            ['hash' => Hash::check($request->password, $usuario->password)],
            ['hash' => 'accepted'],
            ['accepted' => 'Usuario o contraseña incorrectos'],
        )->validate();
        return redirect('/pacientes');
    }
}
