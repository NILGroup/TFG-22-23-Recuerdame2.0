<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "url",
        "estado",
        "paciente_id",
        "crea_id"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
