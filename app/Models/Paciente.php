<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "apellidos",
        "genero",
        "lugar_nacimiento",
        "nacionalidad",
        "fecha_nacimiento",
        "tipo_residencia",
        "residencia_actual"
    ];

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    }

    public function recuerdos(){
        return "Falta conectar con modelo : Recuerdo";
        //return $this->hasMany(Recuerdo::class);
    }

    public function sesiones(){
        return "Falta conectar con modelo : Sesion";
        //return $this->hasMany(Sesion::class);
    }
}
