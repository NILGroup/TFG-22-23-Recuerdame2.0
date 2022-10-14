@extends('layouts.structure')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card form-registro">
                    <div class="d-flex justify-content-center">
                        <img src="/img/Marca_recuerdame.png" class="card-img-top logo">
                    </div>

                    <h5 class="text-center text-muted">Registro terapeuta</h5>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>

                        @error('apellidos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" placeholder="Nombre de Usuario" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>

                        @error('usuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                    </div>

                    <input id="rol" type="hidden" name="rol" value=1 required autocomplete="apellidos" autofocus>

                    <div class="d-flex justify-content-center">
                        <button type="submit" id="registrarNuevo" class="btn btn-primary btn-sm">{{ __('Registrar') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush
