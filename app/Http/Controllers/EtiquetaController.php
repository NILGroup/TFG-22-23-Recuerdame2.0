<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

/* Este controlador no tiene uso real en nuestra aplicación */
class EtiquetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showAll()
    {
        return Etiqueta::all()->sortBy("id");
    }

    public function show(int $id)
    {
        return Etiqueta::findOrFail($id);
    }
}
