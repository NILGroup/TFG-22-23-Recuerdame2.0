<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Resumen extends Model
{
    use HasFactory, SoftDeletes;

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
