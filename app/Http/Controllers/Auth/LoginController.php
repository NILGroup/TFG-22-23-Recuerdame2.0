<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function attemptLogin(Request $request){
        $credenciales = $request->only($this->username(), 'password');

        // Verificar si el campo ingresado es un correo electrónico o un número de teléfono
        $tipo = filter_var($credenciales[$this->username()], FILTER_VALIDATE_EMAIL) ? 'email' : 'telefono';
        $contrario = ($tipo == 'telefono' ? 'email' : 'telefono');
        // Agregar el tipo de campo apropiado al array de credenciales
        $credenciales[$tipo] = $credenciales[$this->username()];

        unset($credenciales[$contrario]);
        //throw new \Exception(json_encode($credenciales));
        if (Auth::attempt($credenciales, $request->filled('remember'))) {
            return true;
        }

        return false;
    }
}
