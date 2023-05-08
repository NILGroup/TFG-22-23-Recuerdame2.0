@extends('layouts.structure')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('register') }}">
                {{csrf_field()}}
                <div class="card form-login">
                    <div class="d-flex justify-content-center">
                        <img src="/img/Marca_recuerdame-nobg.png" class="card-img-top">
                    </div>

                    <h5 class="text-center text-muted">Registro terapeuta</h5>

                    <div class="d-block-inline align-items-center mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                        </div>
                        @error('nombre')
                        <span role="alert" class="msgErrorRegister">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-block-inline align-items-center mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>
                        </div>
                        @error('apellidos')
                        <span role="alert" class="msgErrorRegister">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                  


                    <div class="d-block-inline align-items-center mt-4">
                        <div class="d-flex align-items-center ">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                        </div>
                        <span role="alert" class="msgErrorRegister"><strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-block-inline align-items-center mt-4 pb-4">
                        <div class="d-flex flex-row align-items-center ">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">
                            @error('password')
                        </div>
                        <span role="alert" class=" msgErrorRegister">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                
                        <div class="d-flex flex-row align-items-center mt-2">
                            <i class="fas fa-lock fa-lg me-3 fa-fw "></i>
                            <input id="password-confirm" type="password" class=" form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                        </div>
               

                    <input id="rol" class=mt-4" type="hidden" name="rol" value=1 required autocomplete="apellidos" autofocus>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" id="registrarNuevo" class="btn btn-lg btn-primary">{{ __('Registrar') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/general.js"></script>
@endpush