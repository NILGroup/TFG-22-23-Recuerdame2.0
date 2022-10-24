@extends('layouts.structure')

@section('content')

<div class="container-fluid" style="height: 75%">

    @if (is_null($listaRecuerdos)|| empty($listaRecuerdos) || $listaRecuerdos=='[]') {
    <div class="carousel-inner container pt-4 pb-4">
        <div class="hv-box p-4">
            <span class="align-middle text-muted">No se han encontrado recuerdos para esos filtros.</span>
        </div>
    </div>
    @else

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <?php $i = 0; ?>
            @foreach($listaRecuerdos as $recuerdo)
            @if($i==0)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?php echo  $i ?> class="active" aria-label="Slide 1" aria-current="true"></button>
            @else
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?php echo  $i ?> aria-label="Slide 2" class=""></button>

            @endif
            <?php $i++; ?>
            @endforeach
        </div>

        <div class="carousel-inner">
            <?php $j = 0; ?>
            @foreach($listaRecuerdos as $recuerdo)
            @if($j==0)
            <div class="carousel-item active">
                <h1><?php echo $recuerdo->nombre; ?></h1>
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" role="img" aria-label="Placeholder: <?php echo $recuerdo->nombre; ?>" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#444" dy=".3em"><?php echo $recuerdo->nombre; ?></text>
                </svg>
            </div>
            @else
            <div class="carousel-item">
                <h1><?php echo $recuerdo->nombre; ?></h1>
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" role="img" aria-label="Placeholder: <?php echo $recuerdo->nombre; ?>" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em"><?php echo $recuerdo->nombre; ?></text>
                </svg>
            </div>
            @endif
            <?php $j++; ?>
            @endforeach


        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--<h1 value="{{$listaRecuerdos}}">{{$listaRecuerdos}}</h1>-->
    <!--<div id="carouselPrincipal" style="height: 85%" class="carousel carousel-dark slide" data-bs-interval="false" data-bs-ride="carousel">
            <div class="carousel-inner container pt-4">
                <div class="hv-box p-4">
                <!?php
                    $i = 1;
                    $totalRecuerdos = count($listaRecuerdos); ?>
                    @foreach($listaRecuerdos as $recuerdo) 
                    <!?php $item_class = ($i == 1) ? 'carousel-item active' : 'carousel-item'; ?>
                        <div class="<!?php echo $item_class; ?>">
                            <div class="d-block w-100">
                                <div>
                                    <h4 class="text-center hv-title"><!?php echo $recuerdo->nombre ?></h5>
                                    <div class="row hv-container">
                                        <p class="hv-des"><!?php echo nl2br($recuerdo->descripcion )?></p>
                                        <div class="testimonial-group justify-content-center">
                                            <div class="row text-center flex-nowrap">
                                                      
                                    </div>      
                                </div>
                            </div>
                        </div>
                        <!?php
                            $i++;
                        ?>
                    @endforeach
                </div>
            </div>
        </div>-->
    @endif
</div>



@endsection


@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush