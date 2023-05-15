<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResumenHistoriaVida {
    function generarResumen($arrayRecuerdosFinal) {
        /*$search =
            'Eres un gran escritor. Resume brevemente los siguientes recuerdos.
        Todos los verbos del resumen tienen que estar en segunda persona, y en pasado.
        No puedes utilizar la palabra recordaste.
        No puedes utilizar la palabra recuerda. 
        No puedes utilizar la palabra recuerdas.
        No puedes utilizar la palabra inolvidable.
        Incluye en el resumen la fecha en caso de que la haya.';*/

        $search = 'Eres un gran escritor. Resume brevemente los siguientes recuerdos.
        Todos los verbos del resumen tienen que estar en segunda persona, y en pasado.
        No puedes utilizar la palabra recordaste.
        No puedes utilizar la palabra recuerda. 
        No puedes utilizar la palabra recuerdas.
        No puedes utilizar la palabra inolvidable.
        Incluye en el resumen la fecha en caso de que la haya.'.

        $completed_text = '';

        $recuerdosParaIA =  $search;

        foreach ($arrayRecuerdosFinal as $lr) {
            //return $lr['fecha'];
            if (is_null($lr['fecha']) == false)
                $recuerdosParaIA =  $recuerdosParaIA . " En el año " . substr($lr['fecha'], 0, 4) . ", ";
            $recuerdosParaIA = $recuerdosParaIA . $lr['descripcion'] . " ";
        }

        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])
            ->post("https://api.openai.com/v1/chat/completions", [
                "model" => "gpt-3.5-turbo",
                'messages' => [
                    [
                        "role" => "user",
                        "content" => $recuerdosParaIA
                    ]
                ],
                'temperature' => 1.0,
                //"max_tokens" => 200,
                "top_p" => 1,
                "frequency_penalty" => 0.5,
                "presence_penalty" => 0.5,
                //"stop" => ["11."],
            ])
            ->json();

        return $data['choices'][0]['message']['content'];
    }
}