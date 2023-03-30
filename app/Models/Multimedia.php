<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "multimedias";
    protected $fillable = [
        "nombre",
        "fichero",
        "personarelacionada_id",
        "paciente_id"
    ];

    public function evaluacion(){
        
        $gds = $this->evaluacion_gds();
        $mec = $this->evaluacion_mec();
        $cdr = $this->evaluacion_cdr();
        $cus = $this->evaluacion_custom();

        if (isset($gds)) return $gds;
        if (isset($mec)) return $mec;
        if (isset($cdr)) return $cdr;
        if (isset($cus)) return $cus;


    }

    

    public function evaluacion_gds(){
        return $this->hasOne(Evaluacion::class, "multimedia_gds_id");
    }

    public function evaluacion_mec(){
        return $this->hasOne(Evaluacion::class, "multimedia_mec_id");
    }

    public function evaluacion_cdr(){
        return $this->hasOne(Evaluacion::class, "multimedia_cdr_id");
    }

    public function evaluacion_custom(){
        return $this->hasOne(Evaluacion::class, "multimedia_custom_id");
    }

    public function personas_relacionadas(){
        return $this->belongsTo(Personarelacionada::class);
    }

    public function recuerdos()
    {
        return $this->belongsToMany(Recuerdo::class);
    }

    public function sesiones(){
        return $this->belongsToMany(Sesion::class);
    }

    public function actividades(){
        return $this->belongsToMany(Actividad::class);
    }

    public function pacientes(){
        return $this->belongsTo(Paciente::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function getNombre(){
        return substr($this->nombre, 0, 20);
    }

    public function getRuta(){
        $ext = strtolower(pathinfo($this->fichero, PATHINFO_EXTENSION));
       
        $ruta = $this->fichero;

        if ($ext == 'pdf'){
            $ruta = '/img/pdf.png';
        }
        elseif(in_array($ext, array('doc', 'docx'))){
            $ruta = '/img/word.jpg';
        }
        elseif (in_array($ext, array('ppt', 'pptx', 'pptm'))){
            $ruta = '/img/power.jpg';
        }
        elseif (in_array($ext, array('xlsx', 'xlsm', 'xlsb'))){
            $ruta = '/img/excel.jpg';
        }
        elseif (in_array($ext, array('png', 'jpg', 'jpeg'))){
            $ruta = $this->fichero;
        }
        elseif (in_array($ext, array('rar', 'zip', '7zip'))){
            $ruta = '/img/rar.jpg';
        }
        else if (in_array($ext, array('mp4', 'mkv', 'avi'))){
            $ruta = '/img/video.png';
        }
        else if (in_array($ext, array('mp3', 'ogg', 'wav', 'aac'))){
            $ruta = '/img/audio.png';
        }
        else{
            $ruta = '/img/undefined.jpg';
        }

        return $ruta;
    }
}

