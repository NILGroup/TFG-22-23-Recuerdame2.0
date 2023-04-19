<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InformeSesion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $table = "informesesions";

    protected $fillable = [
        "fecha_finalizada",
        "duracion",
        "respuesta",
        "observaciones",
        "barreras",
        "facilitadores",
        "propuestas",
        "participacion_id",
        "complejidad_id",
        "paciente_id",
        "user_id",
        "sesion_id",
    ];

    public function participacion(){
        return $this->belongsTo(Participacion::class);
    }

    public function complejidad(){
        return $this->belongsTo(Complejidad::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sesion(){
        return $this->belongsTo(Sesion::class);
    }
}
