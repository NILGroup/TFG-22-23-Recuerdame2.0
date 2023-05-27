<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;


/* Este controlador no tiene uso real en nuestra aplicación */
class EtapaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showAll()
    {     
        return Etapa::all()->sortBy("id");
    }
  
    public function show(int $id)
    {
        return Etapa::findOrFail($id);    
    }
}
