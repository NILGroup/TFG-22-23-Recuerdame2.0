<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class RolMiddleware
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
        //Asignamos a un cuidador su paciente relacionado si no lo tenía ya
        $user = Auth::user();
        $sesion = $request->session();
        if($user->rol_id == 2 && !property_exists('sesion', 'paciente')){
            $paciente = Paciente::where('cuidador_id',$user->id)->get();
                session()->put('paciente', $paciente->toArray()[0]);
        }
        return $next($request);
    }
}
