<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumen extends Model
{
    use HasFactory;

    protected $fillable = [
        "fecha",
        "titulo",
        "resumen",
        "paciente_id"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
