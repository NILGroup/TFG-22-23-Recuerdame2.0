<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividad extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "start",
        "title",
        "description",
        "paciente_id",
        "color",
        "finished"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function multimedias(){
        return $this->belongsToMany(Multimedia::class);
    }
}
