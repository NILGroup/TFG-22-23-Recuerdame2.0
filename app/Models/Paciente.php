<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "nombre",
        "apellidos",
        "lugar_nacimiento",
        "nacionalidad",
        "fecha_nacimiento",
        "ocupacion",
        "residencia_actual",
        "fecha_inscripcion",
        "residencia_custom",
        "genero_id",
        "genero_custom",
        "residencia_id",
        "estudio_id",
        "situacion_id"
    ];

    public function actividades(){
        return $this->hasMany(Actividad::class);
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    }

    public function diagnostico(){
        return $this->hasOne(Diagnostico::class);
    }

    public function recuerdos(){
        return $this->hasMany(Recuerdo::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function resumenes(){
        return $this->hasMany(Resumen::class);
    }

    public function sesiones(){
        return $this->hasMany(Sesion::class);
    }

    public function personasrelacionadas(){
        return $this->hasMany(Personarelacionada::class);
    }

    public function residencia(){
        return $this->belongsTo(Residencia::class);
    }
    
    public function multimedia(){
        return $this->hasOne(Multimedia::class);
    }

    public function situacion(){
        return $this->belongsTo(Situacion::class);
    }
    
    public function genero(){
        return $this->belongsTo(Genero::class);
    }
    
    public function estudio(){
        return $this->belongsTo(Estudio::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public function informesSesion(){
        return $this->hasMany(InformeSesion::class);
    }
}
