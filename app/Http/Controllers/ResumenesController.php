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

use GuzzleHttp\Client;

class ResumenesController extends Controller
{
    public function create(Request $request)
    {
        $show = false;
        $resumen = new Resumen();
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

        $data = Http::withHeaders([
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
                  ->json();

        //$completions = json_decode($data, true);
        //$completed_text = $data['choices'][0]['message']['content'];
        $resumen->resumen = $data['choices'][0]['message']['content'];

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

    public function update(Request $request) {
        $resumen = Resumen::updateOrCreate(
            ['id' => $request->id],
            [
                'fecha' => $request->fecha,
                'titulo' => $request->titulo,
                'resumen' => $request->resumen,
                'paciente_id' => $request->paciente_id
            ]
        );

        session()->put('created', "Actualizado");

        //return redirect("/usuarios/$resumen->paciente_id/resumenes/$resumen->id");
        return "<h1>$request-></h1>";
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
