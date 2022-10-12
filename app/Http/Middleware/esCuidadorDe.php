<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;

class esCuidadorDe
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
        //throw new \Exception(json_encode($request->route()));
        if($user->rol_id == 2 && array_values($request->route()->parameters)[0] != $request->session()->get("paciente")['id'] ){
            $paciente = Paciente::where('cuidador_id',$user->id)->get();
            $id = $paciente[0]->id;
            return redirect()->route('pacientes.show', ['paciente'=>$id]);
        }
        else
            return $next($request);
    }
}
