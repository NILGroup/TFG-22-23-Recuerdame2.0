<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Sesion;
use App\Models\Recuerdo;
use Illuminate\Http\Request;

class MultimediasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /*
    * Muestra todos los multimedias de la base de datos
    */
    public function show(Multimedia $multimedia)
    {
        return Multimedia::all()->sortBy("id");
    }

    /*
    * Devuelve los archivos multimedia de un recuerdo concreto
    */
    public function showByRecuerdo($idRecuerdo)
    {
        return Recuerdo::find($idRecuerdo)->multimedias;
    }

    /*
    * Devuelve los archivos multimedia de una sesión concreta
    */
    public function showBySesion($idSesion)
    {
        return Sesion::find($idSesion)->multimedias;
    }

    /*
    * Guarda una foto en la base de datos.
    * Se llama desde dropzones que permiten un
    * único archivo multimedia
    */
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

    /*
    * Guarda una lista de multimedia en la base de datos.
    */
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

   /*
    * Guarda multimedia de recuerdo con
    * descripción en la base de datos.
    */
    public static function savePhotosWithDescriptions(Request $request, $object){
        if ($request->has("file")) { //EN CASO DE MULTIMEDIA
            $name = [];
            $original_name = [];

            $counter = 0;
            foreach ($request->file('file') as $key => $value) {
                $image = uniqid() . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path() . '/storage/img';
                $value->move($destinationPath, $image);
                $name[] = $image;
                $original_name[] = $value->getClientOriginalName();
                $multimedia = Multimedia::create([
                    'nombre' => $value->getClientOriginalName(),
                    'fichero' => '/storage/img/' . $image,
                    'descripcion' => $request->descripciones[$counter]
                ]);

                $object->multimedias()->attach($multimedia->id);
                $counter++;
            }
        }
    }
}
