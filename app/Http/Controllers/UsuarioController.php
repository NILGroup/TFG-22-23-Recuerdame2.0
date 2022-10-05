<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return "Esta es la index del usuario ";
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "Aquí el formulario de creación";
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
            'email' => 'required|unique',
            'usuario' => 'required|unique',
            'password' => 'required',
            'rol' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required'
        ]);


        $usuario = Usuario::updateOrCreate(
            ['id' => $request->id],
            ['nombre' => $request->nombre,
             'apellidos' => $request->apellidos,
             'usuario' => $request->usuario,
             'email' => $request->email,
             'password' => $request->password,
             'rol' => $request->rol]
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
        $usuario->password = $usuario->password;
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
}
