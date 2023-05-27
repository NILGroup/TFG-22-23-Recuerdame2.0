<?php

namespace App\Http\Controllers;

use App\Models\Tiporelacion;
use Illuminate\Http\Request;

/* Este controller no tiene uso real en la aplicación */
class TipoRelacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Tiporelacion::all()->sortBy("id");
    }

    public function show(int $id)
    {
        return Tiporelacion::findOrFail($id);
    }

    public function storeNoView(Request $request){
        Tiporelacion::create(["nombre" => $request->nombre]);
    }


    
}
