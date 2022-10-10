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
        "residencia_actual",
        "cuidador_id"
    ];

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    }

    public function recuerdos(){
        return $this->hasMany(Recuerdo::class);
    }

    public function sesiones(){
        return $this->hasMany(Sesion::class);
    }

    public function personasrelacionadas(){
        return $this->hasMany(Personarelacionada::class);
    }

    public function usuarios(){
        return $this->belongsToMany(User::class);
    }
}
