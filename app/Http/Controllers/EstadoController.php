<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;


/* Este controlador no tiene uso real en nuestra aplicación */
class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Estado::all()->sortBy("id");
    }
}
