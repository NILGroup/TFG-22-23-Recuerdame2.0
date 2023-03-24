<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complejidad extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ["nombre"];

    public function sesiones(){
        return $this->hasMany(Sesion::class);
    }
}
