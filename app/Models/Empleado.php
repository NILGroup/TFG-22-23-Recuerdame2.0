<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function telefono(){
        return $this->hasOne(Telefono::class);
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }



}
