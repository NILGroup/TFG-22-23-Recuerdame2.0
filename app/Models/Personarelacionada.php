<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personarelacionada extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "nombre",
        "apellidos",
        "telefono",
        "ocupacion",
        "email",
        "localidad",
        "contacto",
        "observaciones",
        "tiporelacion_id",
        "tipo_custom",
        "paciente_id"
    ];

    public function multimedia(){
        return $this->hasOne(Multimedia::class);
    }

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
