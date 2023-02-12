<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;


class esTerapeuta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user->rol_id != 1){
            $paciente = Paciente::where('cuidador_id',$user->id)->get();
            //https://youtu.be/g-Y9uiAjOE4
            $id = $paciente[0]->id;
            return redirect()->route('pacientes.show', ['paciente'=>$id]);
        }
        else
            return $next($request);
    }
}
