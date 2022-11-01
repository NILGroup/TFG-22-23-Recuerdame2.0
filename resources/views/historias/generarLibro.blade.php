@extends('layouts.structure')

@section('content')

<div class="container-fluid" style="height: 75%">
    @if (is_null($listaRecuerdos)|| empty($listaRecuerdos) || $listaRecuerdos=='[]') 
        <div class="carousel-inner container pt-4 pb-4">
            <div class="hv-box p-4">
                <span class="align-middle text-muted">No se han encontrado recuerdos para esos filtros.</span>
            </div>
        </div>
    @else
        <div id="carouselPrincipal" style="height: 85%" class="carousel carousel-dark slide">

            <div class="carousel-indicators">
                <?php $l = 0; ?>
                @foreach($listaRecuerdos as $recuerdo)
                @if($l==0)
                <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to={{$l}} class="active" aria-label="Slide {{$l}}" aria-current="true"></button>
                @else
                <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to={{$l}} aria-label="Slide {{$l}}" class=""></button>

                @endif
                <?php $l++; ?>
                @endforeach
            </div>

            <div class="carousel-inner container pt-4">
                <div class="hv-box p-4">
                    <?php
                    $i = 0; ?>
                    @foreach($listaRecuerdos as $recuerdo)
                    @if($i==0)
                    <div class="carousel-item active">
                        <div class="d-block w-100">
                            <div class="w-100">
                                <h4 class="text-center hv-title">{{$recuerdo->nombre}}</h4>
                                <div class="row hv-container ">
                                    <p class="hv-des">{{$recuerdo->descripcion}}</p>


                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <div class="d-block w-100">
                            <div>
                                <h4 class="text-center hv-title">{{$recuerdo->nombre}}</h4>
                                <div class="row hv-container">
                                    <p class="hv-des">{{$recuerdo->descripcion}}</p>
                                    <div class="testimonial-group justify-content-center">
                                        <div class="row text-center flex-nowrap">



                                            @foreach($recuerdo->multimedias as $mult)
                                            <div class="col-sm-5 col-md-4 col-lg-3">
                                                <a href="#" class="visualizarImagen"><img src="{{$mult->fichero}}" class="img-responsive card-img-top img-thumbnail" alt="{{$mult->nombre}}" /></a>
                                                <div>
                                                    <h6 class="text-muted">{{$mult->nombre}}</h6>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <?php $i++; ?>
                    @endforeach
                </div>
            </div>

            <button class="carousel-control-prev hv-control" data-bs-target="#carouselPrincipal" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next hv-control" data-bs-target="#carouselPrincipal" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
        <div class="text-center pb-2 mt-3">
            <span class="text-muted">Fecha: {{Carbon\Carbon::parse($fechaInicio)->format('d/m/Y');}} - {{ Carbon\Carbon::parse($fechaFin)->format('d/m/Y');}}
                @if (isset($etapa))
                    , Etapa: {{$etapa}}
                @endif
                @if(isset($categoria))
                    , Categoría: {{$categoria}}
                @endif
                @if (isset($etiqueta))
                    , Etiqueta: {{$etiqueta}}
                @endif 
            </span>
        </div>
        <div class="text-center">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    @endif
</div>



@endsection


@push('scripts')
    @include('layouts.scripts')
    <!--
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    -->
@endpush