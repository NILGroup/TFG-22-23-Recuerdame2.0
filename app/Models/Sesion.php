<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "fecha",
        "titulo",
        "objetivo",
        "acciones",
        "descripcion",
        "etapa_id",
        "paciente_id",
        "user_id",
    ];

    public function etapa(){
        return $this->belongsTo(Etapa::class);
    }

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

    public function multimedias(){
        return $this->belongsToMany(Multimedia::class);
    }

    public function recuerdos(){
        return $this->belongsToMany(Recuerdo::class);
    }

    public function informes(){
        return $this->hasMany(InformeSesion::class);
    }
}
