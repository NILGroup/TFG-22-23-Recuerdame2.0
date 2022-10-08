@extends('layouts.structure')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card form-login">
                        <img src="/img/Marca_recuerdame.png" class="card-img-top">
                        <div class="card-body">
                            <div class="row mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Correo electrónico o contraseña incorrectos</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="row mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Correo electrónico o contraseña incorrectos</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuerdame') }}
                                </label>
                            </div>
                            <div class="d-grid gap-2  justify-content-md-end">
                                <div class="btn-group">
                                    <a href="/register" class="btn btn-outline-primary btn-sm">{{ __('Registro terapeuta') }}</a>
                                    <button type="submit" name="login" style="border-color:green;" class="btn btn-primary btn-sm">{{ __('Iniciar sesión') }}</button>
                                </div>
                            </div>
                            <p></p>
                            <p></p>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('He olvidado mi contraseña') }}
                                </a>
                            @endif
                        </div>
                        </div>
                    </div>


                    <!--
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Correo electrónico o contraseña incorrectos</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Correo electrónico o contraseña incorrectos</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuerdame') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('He olvidado mi contraseña') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4 ">
                            <a href="/register" class="btn btn-outline-primary btn-sm">Registro terapeuta</a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Iniciar sesión') }}
                            </button>
                        </div>
                    </div>
                    -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
