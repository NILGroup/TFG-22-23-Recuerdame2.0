<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Sesion;
use App\Models\Recuerdo;
use Illuminate\Http\Request;

class MultimediasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "Index de la Multimedia";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra todos los multimedias de la base de datos
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedia $multimedia)
    {
        return Multimedia::all()->sortBy("id");
    }

    //Devuelve los archivos multimedia de un recuerdo concreto
    public function showByRecuerdo($idRecuerdo)
    {
        return Recuerdo::find($idRecuerdo)->multimedias;
    }

    //Devuelve los archivos multimedia de un recuerdo concreto
    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->multimedias;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Multimedia $multimedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multimedia $multimedia)
    {
        //
    }

    public static function savePhoto(Request $request, $objeto){
        $name = [];
        $original_name = [];
        if ($request->has("file")){
            foreach ($request->file('file') as $key => $value) {
                $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path() . '/storage/img';
                $value->move($destinationPath, $image);
                $name[] = $image;
                $original_name[] = $value->getClientOriginalName();
                $multimedia = new Multimedia([
                    'nombre' => $value->getClientOriginalName(),
                    'fichero' => '/storage/img/' . $image
                ]);
                $objeto->multimedia()->save($multimedia);
            }
        }
    }

    public static function savePhotos(Request $request, $object){
        if ($request->has("file")) { //EN CASO DE MULTIMEDIA
            $name = [];
            $original_name = [];
            foreach ($request->file('file') as $key => $value) {
                $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path() . '/storage/img';
                $value->move($destinationPath, $image);
                $name[] = $image;
                $original_name[] = $value->getClientOriginalName();
                $multimedia = Multimedia::create([
                    'nombre' => $value->getClientOriginalName(),
                    'fichero' => '/storage/img/' . $image
                ]);

                $object->multimedias()->attach($multimedia->id);
            }
        }
    }
}
