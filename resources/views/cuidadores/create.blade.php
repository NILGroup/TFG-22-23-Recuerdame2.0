@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Registro cuidador</h5>
        <hr class="lineaTitulo">
    </div>

    <form method="POST" action="/registroCuidador" id="formulario">
        @csrf
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nick" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input id="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                    @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input id="apellidos" type="text" class="form-control form-control-sm @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>
                    @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input id="telefono" type="text" class="form-control form-control-sm @error('telefono') is-invalid @enderror" placeholder="Número de teléfono" name="telefono" value="{{ old('telefono') }}"required autocomplete="telefono" autofocus>

                    @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-7">
                <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad</label>
                <div class="col-sm-6 col-md-6 col-lg-8">
                    <input id="localidad" type="text" class="form-control form-control-sm" placeholder="Localidad de residencia" name="localidad" value="{{ old('localidad') }}" autocomplete="localidad" autofocus>
                </div>
            </div>
        </div>
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Correo<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contraseña<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Paciente<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select class="form-select form-select-sm" id="paciente" name="paciente" required>
                        <option value=""></option>
                        @foreach($pacientes as $p)
                        <option value="{{$p->id}}" @if(!is_null($paciente) && $paciente->id == $p->id) selected @endif>
                            {{$p->nombre}} {{$p->apellido}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-7">
                <label for="parentesco" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Parentesco</label>
                <div class="col-sm-6 col-md-6 col-lg-8">
                    <select class="form-select form-select-sm" id="parentesco" name="parentesco">
                        <option value=""></option>
                        <option value="Primer Grado">Primer Grado</option>
                        <option value="Segundo Grado">Segundo Grado</option>
                        <option value="Tercer Grado">Tercer Grado</option>
                        <option value="Cuarto Grado">Cuarto Grado</option>
                        <option value="Quinto Grado">Quinto Grado</option>
                        <option value="Sexto Grado">Sexto Grado</option>
                    </select>
                </div>
            </div>
        </div>
        <input id="rol" type="hidden" name="rol" value=2 required autocomplete="apellidos" autofocus>

        <div class="col-12">
            <button type="submit" value="Guardar" id="guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/validacion.js"></script>
@endpush