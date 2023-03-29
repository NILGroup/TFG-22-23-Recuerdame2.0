<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostico extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        "paciente_id",
        "enfermedad",
        "fecha",
        "gds",
        "gds_fecha",
        "mental",
        "mental_fecha",
        "cdr",
        "cdr_fecha",
        "antecedentes",
        "observaciones",
        "nombre_escala",
        "escala",
        "fecha_escala"
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function multimedia_gds() { 
        return $this->belongsTo(Multimedia::class, "multimedia_gds_id");
    }

    public function multimedia_mec() { 
        return $this->belongsTo(Multimedia::class, "multimedia_mec_id");
    }
    public function multimedia_cdr() { 
        return $this->belongsTo(Multimedia::class, "multimedia_cdr_id");
    }
    public function multimedia_custom() { 
        return $this->belongsTo(Multimedia::class, "multimedia_custom_id");
    }

}
