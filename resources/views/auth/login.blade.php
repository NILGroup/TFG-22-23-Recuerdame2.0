@extends('layouts.structure')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="card form-login">
                    
                    <form method="POST" action="{{ route('login') }}">
                        {{csrf_field()}}
                        <img src="/img/Marca_recuerdame-nobg.png" class="card-img-top">
                        <div class="card-body">
                            <div class="row mb-3 form-floating mb-3">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico" autofocus>
                                <label class="text-muted" for="email">Correo electrónico o teléfono</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> Correo electrónico o contraseña incorrectos</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3 form-floating mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">
                                <label class="text-muted" for="password">Contraseña</label>
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
                                <!-- <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('He olvidado mi contraseña') }}</a> -->
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="/prueba" method="post">
    {{csrf_field()}}
    <!-- <input type="submit" value="Boton oculto para llenar la base de datos y que no se dupliquen los Migueles" style="background-color: cyan;"> -->
</form>
@endsection


@push('scripts')
    @include('layouts.scripts')
    <script src="/js/general.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script>
        $("#rellenaBBDD").on("click", function(event){
            event.stopPropagation()
            event.preventDefault()

            var fd = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: '/prueba',
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                async: false,
                data: fd,
                success: function (data) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        text:  'Se ha rellenado la base de datos',
                        backdrop: false,
                        width:"20em",
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 2500,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                    })
                },
                error: function (data) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        text:  'Ha ocurrido un error',
                        backdrop: false,
                        width:"20em",
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 2500,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                    })
                }
            })
        })
    </script>
@endpush
