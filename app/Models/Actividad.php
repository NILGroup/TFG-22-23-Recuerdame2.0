<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "start",
        "title",
        "description",
        "paciente_id",
        "color"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
