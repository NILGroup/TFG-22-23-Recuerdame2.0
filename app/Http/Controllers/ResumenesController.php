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

use App\ResumenHistoriaVida;

use GuzzleHttp\Client;

class ResumenesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role'])->except(['show']);
        $this->middleware(['asignarPaciente'])->except(['destroy', 'restore']);
    }

    public function create(Request $request)
    {
        $show = false;
        $resumen = new Resumen();
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
            $titulo = $titulo . Etapa::find($i + 1)['nombre'];
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

        $titulo = "Resumen " . $titulo; 

        //return $titulo;

        /*if (in_array('1', $idEtapa)) {
            //Recuerdos Infancia Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', '1')
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
                    ->where('etapa_id', '1')
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
                for ($i = 0; $i < $max; $i++) {
                    $aux = 0;
                    if ($i < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$i];
                        $aux++;
                    }
                    if ($i < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$i];
                        $aux++;
                    }
                }
            } else
                $arrayRecuerdosMezclaEtapa = $array1;

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }*/
        /****************************************************************************************/
        /*if (in_array('2', $idEtapa)) {
            //Recuerdos Adolescencia Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', '2')
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

            //Recuerdos Adolescencia No Aptos
            if ($noApto == '1') {
                $array2 =  $paciente->recuerdos()
                    ->where('etapa_id', '2')
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
                for ($i = 0; $i < $max; $i++) {
                    $aux = 0;
                    if ($i < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$i];
                        $aux++;
                    }
                    if ($i < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$i];
                        $aux++;
                    }
                }
            } else
                $arrayRecuerdosMezclaEtapa = $array1;

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }*/
        /****************************************************************************************/
        /*if (in_array('3', $idEtapa)) {
            //Recuerdos Adulto Joven Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', '3')
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

            //Recuerdos Adulto Joven No Aptos
            if ($noApto == '1') {
                $array2 =  $paciente->recuerdos()
                    ->where('etapa_id', '3')
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
                for ($i = 0; $i < $max; $i++) {
                    $aux = 0;
                    if ($i < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$i];
                        $aux++;
                    }
                    if ($i < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$i];
                        $aux++;
                    }
                }
            } else {
                $arrayRecuerdosMezclaEtapa = $array1;
            }

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }*/
        /****************************************************************************************/
        /*if (in_array('4', $idEtapa)) {
            //Recuerdos Adulto Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', '4')
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
            //Recuerdos Adulto No Aptos
            if ($noApto == '2') {
                $array2 =  $paciente->recuerdos()
                    ->where('etapa_id', '4')
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
                for ($i = 0; $i < $max; $i++) {
                    $aux = 0;
                    if ($i < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$i];
                        $aux++;
                    }
                    if ($i < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$i];
                        $aux++;
                    }
                }
            } else
                $arrayRecuerdosMezclaEtapa = $array1;

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }*/
        /****************************************************************************************/
        /*if (in_array('5', $idEtapa)) {
            //Recuerdos Adulto Mayor Aptos
            if ($apto == '1') {
                $array1 =  $paciente->recuerdos()
                    ->where('etapa_id', '5')
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
            //Recuerdos Adulto Mayor No Aptos
            if ($noApto == '1') {
                $array2 =  $paciente->recuerdos()
                    ->where('etapa_id', '5')
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
                for ($i = 0; $i < $max; $i++) {
                    $aux = 0;
                    if ($i < sizeOf($array1)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array1[$i];
                        $aux++;
                    }
                    if ($i < sizeOf($array2)) {
                        $arrayRecuerdosMezclaEtapa[$aux] = $array2[$i];
                        $aux++;
                    }
                }
            } else
                $arrayRecuerdosMezclaEtapa = $array1;

            $arrayRecuerdosFinal = array_merge($arrayRecuerdosFinal, $arrayRecuerdosMezclaEtapa);
        }*/

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


        $resumenGenerator = new ResumenHistoriaVida();

        //return $arrayRecuerdosFinal[2]['puntuacion'];

        //$recuerdosParaIA = 

        //return $recuerdosParaIA;



        //$completions = json_decode($data, true);
        //$completed_text = $data['choices'][0]['message']['content'];
        $resumen->resumen = $resumenGenerator->generarResumen($arrayRecuerdosFinal);
        $resumen->titulo = $titulo;

        //return $resumen;
        //return $data['choices'][0]['message']['content'];
        return view("resumenes.create", compact("paciente", "resumen"));
    }

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
        //return "<h1>$request</h1>";
    }

    public function index(Request $request)
    {
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $idEtiqueta = $request->seleccionEtiq;
        $idCategoria = $request->seleccionCat;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $paciente = Paciente::find($idPaciente);

        if (is_null($idEtapa))
            $idEtapa = Etapa::select('id');
        if (is_null($idEtiqueta))
            $idEtiqueta = Etiqueta::select('id');
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id');

        $listaRecuerdos =  $paciente->recuerdos()
            ->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id')
            ->whereIn('etiqueta_id', $idEtiqueta)->orWhereNull('etiqueta_id')
            ->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();


        $search = 'Eres un gran escritor. Resume brevemente los siguientes recuerdos.
        Todos los verbos del resumen tienen que estar en segunda persona, y en pasado. 
        No puedes utilizar la palabra recordaste.
        No puedes utilizar la palabra recuerda.
        No puedes utilizar la palabra recuerdas.
        No puedes utilizar la palabra inolvidable.
        Incluye en el resumen la fecha en caso de que la haya.';

        $completed_text = '';

        $recuerdosParaIA =  $search;

        foreach ($listaRecuerdos as $lr) {
            $recuerdosParaIA =  $recuerdosParaIA . " Momento: ";
            if (is_null($lr->fecha) == false)
                $recuerdosParaIA =  $recuerdosParaIA . "El día " . $lr->fecha;
            $recuerdosParaIA = $recuerdosParaIA . $lr->descripcion . " ";
        }

        /* $data = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
                  ])
                  ->post("https://api.openai.com/v1/chat/completions", [
                    "model" => "gpt-3.5-turbo",
                    'messages' => [
                        [
                           "role" => "user",
                           "content" => $recuerdosParaIA
                       ]
                    ],
                    'temperature' => 1,
                    //"max_tokens" => 200,
                    "top_p" => 1.0,
                    "frequency_penalty" => 0.52,
                    "presence_penalty" => 0.5,
                    "stop" => ["11."],
                  ])
                  ->json();*/

        //$completions = json_decode($data, true);
        //$completed_text = $data['choices'][0]['message']['content'];
        $completed_text = $recuerdosParaIA;

        //return $data['choices'][0]['message']['content'];
        return view("resumenes.create", compact("paciente", "completed_text"));
    }

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

        //return redirect("/usuarios/$resumen->paciente_id/resumenes/$resumen->id");
        return "<h1>$request->idResumen</h1>";
    }

    public function show($idPaciente, $idResumen)
    {
        $show = true;
        $resumen = Resumen::find($idResumen);
        $paciente = $resumen->paciente;
        return view("resumenes.show", compact("resumen", "paciente"));
    }

    public function destroy($id)
    {
        $resumen = Resumen::find($id);
        $resumen->delete();
        //return redirect("/usuarios/$idP/sesiones");
    }
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

    public function showByPaciente($idPaciente)
    {
        $paciente = Paciente::findOrFail($idPaciente);
        $resumenes = $paciente->resumenes;
        return view("resumenes.showByPaciente", compact("paciente", "resumenes"));
        //return "<h1>$resumenes</h1>";
    }


    /*public function index(Request $request)
    {
        $idPaciente = $request->paciente_id;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $idEtapa = $request->seleccionEtapa;
        $idEtiqueta = $request->seleccionEtiq;
        $idCategoria = $request->seleccionCat;
        $apto = $request->apto;
        $noApto = $request->noApto;
        $paciente = Paciente::find($idPaciente);

        if (is_null($idEtapa))
            $idEtapa = Etapa::select('id');
        if (is_null($idEtiqueta))
            $idEtiqueta = Etiqueta::select('id');
        if (is_null($idCategoria))
            $idCategoria = Categoria::select('id');

        $listaRecuerdos =  $paciente->recuerdos()
            ->whereIn('etapa_id', $idEtapa)->orWhereNull('etapa_id')
            ->whereIn('etiqueta_id', $idEtiqueta)->orWhereNull('etiqueta_id')
            ->whereIn('categoria_id', $idCategoria)->orWhereNull('categoria_id')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        $sentencia = 'Eres un gran escritor. Resume brevemente el siguiente texto. 
        Todos los verbos del resumen tienen que estar en segunda persona, y en pasado. 
        No puedes utilizar la palabra recordaste.
        No puedes utilizar la palabra recuerda.
        No puedes utilizar la palabra recuerdas.
        No puedes utilizar la palabra inolvidable. 
        Debes incluir en el resúmen la fecha en que ocurrió cada uno, escribiendo el mes.
';
        $completed_text = '';
        $cliente = new Client();
        foreach ($listaRecuerdos as $lr) {
            
            $recuerdosParaIA =  $sentencia . " Fecha: " . $lr->fecha . " Momento: " . $lr . $lr->descripcion . " ";
            $response = $cliente->post('https://api.openai.com/v1/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer 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',
                ],
                'json' => [
                    'prompt' => $recuerdosParaIA,
                    'max_tokens' => 3500,
                    'model' => 'text-davinci-002',
                    'temperature' => 0
                ],
            ]);
            $body = $response->getBody();
            $completions = json_decode($body, true);
            $completed_text = $completed_text . $completions['choices'][0]['text'];
        }
        //$completed_text = $recuerdosParaIA;

        return view("resumenes.show", compact("paciente", "completed_text"));
        //return "<h1>$completed_text</h1>";
        //return "<h1>Prueba</h1>";
    }*/
}
