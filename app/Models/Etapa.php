<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $fillable = ["nombre"];

    public function recuerdos(){
        return "Falta conectar con modelo : Recuerdo";
        //return $this->hasMany(Recuerdo::class);
    }

    public function sesiones(){
        return $this->hasMany(Sesion::class);
    }
}
