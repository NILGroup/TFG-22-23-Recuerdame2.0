<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "fichero"
    ];

    public function recuerdos()
    {
        return $this->belongsToMany(Recuerdo::class);
    }

    public function sesions(){
        return $this->belongsToMany(Sesion::class);
    }
}

