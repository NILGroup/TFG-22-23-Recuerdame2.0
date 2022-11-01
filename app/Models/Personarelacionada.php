<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personarelacionada extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "nombre",
        "apellidos",
        "telefono",
        "ocupacion",
        "email",
        "tiporelacion_id",
        "paciente_id"
    ];

    public function tiporelacion(){
        return $this->belongsTo(Tiporelacion::class);
    }

    public function recuerdos(){
        return $this->belongsToMany(Recuerdo::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
