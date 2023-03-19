<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluacion extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "paciente_id",
        "fecha",
        "gds",
        "gds_fecha",
        "mental",
        "mental_fecha",
        "cdr",
        "cdr_fecha",
        "diagnostico",
        "observaciones",
        "nombre_escala",
        "escala",
        "fecha_escala"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
