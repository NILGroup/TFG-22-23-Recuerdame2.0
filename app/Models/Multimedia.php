<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "multimedias";
    protected $fillable = [
        "nombre",
        "fichero",
        "personarelacionada_id"
    ];

    public function personas_relacionadas(){
        return $this->belongsTo(Personarelacionada::class);
    }

    public function recuerdos()
    {
        return $this->belongsToMany(Recuerdo::class);
    }

    public function sesiones(){
        return $this->belongsToMany(Sesion::class);
    }

    public function pacientes(){
        return $this->belongsToMany(Paciente::class);
    }
}

