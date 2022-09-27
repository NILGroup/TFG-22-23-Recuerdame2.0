<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personarelacionada extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "apellidos",
        "telefono",
        "ocupacion",
        "email",
        "tiporelacion_id"
    ];

    public function tipo_relacion(){
        return $this->belongsTo(Tiporelacion::class);
    }

    public function recuerdos(){
        return $this->belongsToMany(Recuerdo::class);
    }
}
