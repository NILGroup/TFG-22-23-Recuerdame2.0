<?php

namespace App\Http\Controllers;

use App\Models\Emocion;
use Illuminate\Http\Request;

class EmocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Emocion::all();
    }

    
}
