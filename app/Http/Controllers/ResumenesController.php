<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

use App\Models\Paciente;
use App\Models\Etapa;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Resumen;
use Carbon\Carbon;

use App\ResumenHistoriaVida;

use GuzzleHttp\Client;

class ResumenesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role'])->except(['show']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }

    /*
    * Genera el resumen de la historia de vida
    */
    public function create(Request $request)
    {
        $show = false;
        $resumen = new Resumen();

        //OBTENER LOS RECUERDOS BUSCADOS///////////////////////////////////////////////////
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

        if ($apto == '0' && $noApto == '0') {
            $apto = 1;
            $noApto = 1;
        }

        if (is_null($idEtapa)) {
            $idTodasEtapas = Etapa::select('id')->get();
            for ($i = 0; $i < sizeOf($idTodasEtapas); $i++) {
                $idEtapa[$i] = $idTodasEtapas[$i]['id'];
            }
        }
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id')->get();
        if (is_null($puntuacion))
            $puntuacionFinal = collect([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        else {
            if (in_array("1", $puntuacion)) {
                $puntuacionFinal->push(6, 7, 8, 9, 10);
            }
            if (in_array("2", $puntuacion)) {
                $puntuacionFinal->push(5);
            }
            if (in_array("3", $puntuacion)) {
                $puntuacionFinal->push(0, 1, 2, 3, 4);
            }
        }

        $arrayRecuerdosMezclaEtapa = array();
        $arrayRecuerdosFinal = array();
        $array1 = array();
        $array2 = array();
        $titulo = "";

        for ($i = 0; $i < sizeof($idEtapa); $i++) {
            $titulo = $titulo . Etapa::find($idEtapa[$i])['nombre'];
            if($i < sizeOf($idEtapa) - 1)
                $titulo = $titulo . " - ";

            //Recuerdos Infancia Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', $idEtapa[$i])
                    ->where(function ($query) use ($idCategoria) {
                        $query->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id');
                    })
                    ->where(function ($query) use ($puntuacionFinal) {
                        $query->whereIn('puntuacion', $puntuacionFinal)->orWhereNull('puntuacion');
                    })
                    ->where(function ($query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('fecha', [$fechaInicio, $fechaFin])->orWhereNull('fecha');
                    })
                    ->where('apto', '1')->get()->sortBy('fecha')->toArray();
            } else {
                $array1 = [];
            }
            //Recuerdos Infancia No Aptos
            if ($noApto == '1') {
                $array2 =  $paciente->recuerdos()
                    ->where('etapa_id', $idEtapa[$i])
                    ->where(function ($query) use ($idCategoria) {
                        $query->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id');
                    })
                    ->where(function ($query) use ($puntuacionFinal) {
                        $query->whereIn('puntuacion', $puntuacionFinal)->orWhereNull('puntuacion');
                    })
                    ->where(function ($query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('fecha', [$fechaInicio, $fechaFin])->orWhereNull('fecha');
                    })
                    ->where('apto', '0')->get()->sortBy('fecha')->toArray();
            } else {
                $array2 = [];
            }

            if (empty($array1) == FALSE && empty($array2) == TRUE)
                $arrayRecuerdosMezclaEtapa = $array1;
            else if (empty($array1) == TRUE && empty($array2) == FALSE)
                $arrayRecuerdosMezclaEtapa = $array2;
            else if (empty($array1) == FALSE && empty($array2) == FALSE) {
                $max = max(sizeOf($array1), sizeOf($array2));
                for ($j = 0; $j < $max; $j++) {
                    $aux = 0;
                    if ($j < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$j];
                        $aux++;
                    }
                    if ($j < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$j];
                        $aux++;
                    }
                }
            } else
                $arrayRecuerdosMezclaEtapa = $array1;

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }

        //FIN. RECUERDOS YA OBTENIDOS///////////////////////////////////////////////////

        if(sizeof($arrayRecuerdosFinal) == 0){
            $listaRecuerdos = collect();
            return view("historias.generarLibro", compact("fechaInicio", "fechaFin", "listaRecuerdos"));
        }

        $titulo = "Resumen " . $titulo; 

        $listaRecuerdos =  $paciente->recuerdos()
            ->where(function ($query) use ($idEtapa) {
                $query->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id');
            })->where(function ($query) use ($idCategoria) {
                $query->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id');
            })->where(function ($query) use ($puntuacionFinal) {
                $query->whereIn('puntuacion', $puntuacionFinal)->orWhereNull('puntuacion');
            })->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha', [$fechaInicio, $fechaFin])->orWhereNull('fecha');
            })
            ->get()->sortBy('fecha')->toArray();


        //Llamada a ResumenHistoriaVida para obtener el resumen
        $resumenGenerator = new ResumenHistoriaVida();
        $resumen->resumen = $resumenGenerator->generarResumen($arrayRecuerdosFinal);
        $resumen->titulo = $titulo;
        $resumen->fecha = Carbon::now()->format("Y-m-d");

        return view("resumenes.create", compact("paciente", "resumen"));
    }

    /*
    * Guarda el resumen de la historia de vida
    */
    public function store(Request $request)
    {
        //Ahora que tenemos creado el recuerdo
        $resumen = Resumen::updateOrCreate(
            ['id' => $request->id],
            [
                'fecha' => $request->fecha,
                'titulo' => $request->titulo,
                'resumen' => $request->resumen,
                'paciente_id' => $request->paciente_id
            ]
        );

        session()->put('created', "true");

        return redirect("/usuarios/" . $resumen->paciente_id . "/resumenes");
    }

    /*
    * Guarda el resumen de la historia de vida
    */
    public function update(Request $request)
    {
        $resumen = Resumen::updateOrCreate(
            ['id' => $request->idResumen],
            [
                'fecha' => $request->fecha,
                'titulo' => $request->titulo,
                'resumen' => $request->resumen,
                'paciente_id' => $request->paciente_id
            ]
        );

        session()->put('created', "Actualizado");

        return redirect("/usuarios/$resumen->paciente_id/resumenes/$resumen->id");
        //return "<h1>$request->idResumen</h1>";
    }

    public function show($idPaciente, $idResumen)
    {
        $show = true;
        $resumen = Resumen::find($idResumen);
        $paciente = $resumen->paciente;
        return view("resumenes.show", compact("resumen", "paciente"));
    }

    /*
    * Elimina el resumen de la historia de vida
    */
    public function destroy($id)
    {
        $resumen = Resumen::find($id);
        $resumen->delete();
    }

    /*
    * Restaura el resumen de la historia de vida
    */
    public function restore($idP, $id)
    {
        Resumen::where('id', $id)->withTrashed()->restore();
    }

    public function showEditable($idPaciente, $idResumen)
    {
        $show = true;
        $resumen = Resumen::find($idResumen);
        $paciente = $resumen->paciente;
        return view("resumenes.edit", compact("resumen", "paciente"));
    }

    /*
    * Lista los resúmenes de la historia de vida
    */
    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $resumenes = $paciente->resumenes;
        return view("resumenes.showByPaciente", compact("paciente", "resumenes"));
    }
}
