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
        //throw new \Exception(json_encode($url[6]));
        
        if(sizeof($url) <= 4){
            return $next($request);
        }

        $paciente = Paciente::find($url[4]);
        if(!Auth::User()->pacientes->contains($url[4])){
            return redirect("/pacientes");
        }

        $valido = true;
        if(sizeof($url) > 6 && is_numeric($url[6]))
            switch ($url[5]):
                case "sesiones":
                    if(!$paciente->sesiones->contains($url[6]))
                        return redirect("/pacientes/$paciente->id/sesiones");
                    break;
                case "evaluaciones":
                    if(!$paciente->evaluaciones->contains($url[6]))
                        return redirect("/pacientes/$paciente->id/evaluaciones");
                    break;
                case "recuerdos":
                    if(!$paciente->recuerdos->contains($url[6]))
                        return redirect("/pacientes/$paciente->id/recuerdos");
                    break;
                case "personas":
                    if(!$paciente->personasrelacionadas->contains($url[6]))
                        return redirect("/pacientes/$paciente->id/personas");
                    break;
                case "cuidadores":
                    if(!$paciente->users->contains($url[6]))
                        return redirect("/pacientes/$paciente->id/cuidadores");
                    break;
                default:
                    break;
            endswitch;
        if(!$valido)
            return redirect("/pacientes");

        session()->put('paciente', $paciente->toArray());
        return $next($request);
    }
}
