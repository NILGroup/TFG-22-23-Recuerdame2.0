<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

use function PHPUnit\Framework\returnSelf;

class HistoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['asignarPaciente'])->except('generarLibroHistoria');
    }

    public function oldestMemoryDate($idPaciente)
    {
        $memory = Paciente::find($idPaciente)->recuerdos
            ->whereNotNull('fecha')
            ->sortBy('fecha')
            ->first();
        
        if ($memory != null) return $memory->fecha;
    }

    public function generarHistoria(int $idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $fecha = $this->oldestMemoryDate($idPaciente);
        $etapas = Etapa::all()->sortBy("id");
        $categorias = Categoria::all()->sortBy("id");
        $etiquetas = Etiqueta::all()->sortBy("id");
        return view("historias.generateHistoria", compact("paciente", "fecha", "etapas", "etiquetas", "categorias"));
    }


    public function generarLibroHistoria(Request $request)
    {
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $puntuacion = $request->seleccionEtiq;
        $idCategoria = $request->seleccionCat;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $paciente = Paciente::find($idPaciente);
        $puntuacionFinal = collect([]);
    
        if (is_null($idEtapa))
            $idEtapa = Etapa::select('id');
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id');
        if (is_null($puntuacion)){
            $puntuacionFinal = collect([0,1,2,3,4,5,6,7,8,9,10]);
        }else {
            
            if(in_array("1", $puntuacion))
            {
                $puntuacionFinal->push(6,7,8,9,10);
            }
            if(in_array("2", $puntuacion))
            {
                $puntuacionFinal->push(5);
            }
            if(in_array("3", $puntuacion))
            {
                $puntuacionFinal->push(0,1,2,3,4);
            }
        }
                

        $listaRecuerdos =  $paciente->recuerdos()
        ->where(function($query) use ($idEtapa){
            $query->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id');

        })->where(function($query) use ($idCategoria){
            $query->whereIn('categoria_id',$idCategoria)->orWhereNull('categoria_id');
                
        })->where(function($query) use ($puntuacionFinal){
            $query ->whereIn('puntuacion', $puntuacionFinal)->orWhereNull('puntuacion');
        
        
        })->where(function($query) use ($fechaInicio,$fechaFin){
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin])->orWhereNull('fecha');
        })
            ->get();

        if(!($apto == 0 && $noApto == 0) && !($apto == 1 && $noApto == 1))
            $listaRecuerdos = $listaRecuerdos
                ->whereIn('apto', $apto);
        return view("historias.generarLibro", compact("fechaInicio", "fechaFin", "listaRecuerdos"));
    }
}
