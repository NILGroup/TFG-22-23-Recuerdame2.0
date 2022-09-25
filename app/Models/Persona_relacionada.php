<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_relacionada extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "apellidos",
        "telefono",
        "ocupacion",
        "email",
        "tipo_relacion_id"
    ];

    public function tipo_relacion(){
        return $this->belongsTo(Tipo_relacion::class);
    }

}
