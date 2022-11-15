<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class asignarPaciente
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
        $url = explode("/", url()->current());
        if(sizeof($url) <= 4){
            session()->forget('paciente');
            return $next($request);
        }
        if(!Auth::User()->pacientes->contains($url[4])){
            return redirect("/pacientes");
        }
        $paciente = Paciente::find($url[4]);
        session()->put('paciente', $paciente->toArray());
        return $next($request);
    }
}
