<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_relacion extends Model
{
    use HasFactory;

    protected $fillable = ["nombre"];

    public function personas_relacionadas(){
        return $this->hasMany(Persona_relacionada::class);
    }
}
