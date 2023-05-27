<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Devuelve la lista completa de categorias
     */
    public function showAll()
    {
        return Categoria::all()->sortBy("id");
    }

    /**
     * Devuelve la categoria especificada
     */
    public function show(int $id)
    {
        return Categoria::findOrFail($id);
    }

   
    
}
