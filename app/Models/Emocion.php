<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emocion extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre"
    ];

    public function recuerdos(){
        return $this->hasMany(Recuerdo::class);
    }
}
