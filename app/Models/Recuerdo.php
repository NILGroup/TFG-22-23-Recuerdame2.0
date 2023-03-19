<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recuerdo extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "fecha",
        "nombre",
        "descripcion",
        "localizacion",
        "etapa_id",
        "categoria_id",
        "tipo_custom",
        "emocion_id",
        "estado_id",
        "etiqueta_id",
        "puntuacion",
        "paciente_id",
        "apto"
    ];

    public function etapa(){
        return $this->belongsTo(Etapa::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function emocion(){
        return $this->belongsTo(Emocion::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function etiqueta(){
        return $this->belongsTo(Etiqueta::class);
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function multimedias(){
        return $this->belongsToMany(Multimedia::class);
    }

    public function sesiones(){
        return $this->belongsToMany(Sesion::class);
    }

    public function personas_relacionadas(){
        return $this->belongsToMany(Personarelacionada::class);
    }
}
