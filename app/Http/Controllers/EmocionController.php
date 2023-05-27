<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use Illuminate\Http\Request;


/* Este controlador no tiene uso real en nuestra aplicación */
class EmocionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Emocion::all()->sortBy("id");
    }
}
