<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "nombre",
        "estado",
        "paciente_id",
        "crea_id",
        "url",
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
