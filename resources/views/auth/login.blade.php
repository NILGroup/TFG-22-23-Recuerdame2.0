@extends('layouts.structure')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <div class="card form-login">
                        <img src="/img/Marca_recuerdame-nobg.png" class="card-img-top">
                        <div class="card-body">
                            <div class="row mb-3 form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico" autofocus>
                            <label class="text-muted" for="email">Correo electrónico</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Correo electrónico o contraseña incorrectos</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="row mb-3 form-floating mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">
                                <label class="text-muted" for="email">Contraseña</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Correo electrónico o contraseña incorrectos</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuérdame') }}
                                </label>
                            </div>
                            <div class="d-grid gap-2  justify-content-md-end">
                                <div class="btn-group mt-5">
                                    <a href="/register" class="btn btn-outline-primary">{{ __('Registro terapeuta') }}</a>
                                    <button type="submit" name="login" style="border-color:green;" class="btn btn-primary">{{ __('Iniciar sesión') }}</button>
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
<form action="/prueba" method="post">
    {{csrf_field()}}
    <input type="submit" value="Boton oculto para llenar la base de datos y que no se dupliquen los Migueles" style="background-color: cyan;">
</form>
@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush
