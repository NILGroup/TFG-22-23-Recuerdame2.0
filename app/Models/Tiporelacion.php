<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiporelacion extends Model
{
    use HasFactory;

    protected $fillable = ["nombre"];

    public function personasrelacionadas(){
        return $this->hasMany(Personarelacionada::class);
    }
}
