<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "apellidos",
        "email",
        "usuario",
        "password",
        "rol"
    ];

    public function sesions()
    {
        return $this->hasMany(Sesion::class);
    }
}
