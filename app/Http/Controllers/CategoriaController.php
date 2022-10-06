<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Devuelve la lista completa de categorias
     */

    public function showAll()
    {
        return Categoria::all();
    }

   

    /**
     * Devuelve la categoria especificada
     */
    public function show($id)
    {
        return Categoria::findOrFail($id);
    }

   
    
}
