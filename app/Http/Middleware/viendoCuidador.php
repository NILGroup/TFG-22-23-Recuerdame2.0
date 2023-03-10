<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;
use App\Models\User;

class viendoCuidador
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
        $paciente = Paciente::find($url[4]);
        if(sizeof($url) > 6 && $url[5] == "cuidadores"){
            if($url[6] != "crear"){
                $u = User::find($url[6]);
                if(is_null($u) || $u->rol_id == 1)
                    return redirect("/pacientes/$paciente->id/cuidadores");
            }
        }
        return $next($request);
    }
}
