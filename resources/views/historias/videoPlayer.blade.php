@extends('layouts.structure')

@section('content')

<div class="container-fluid" style="height: 80% !important">
<div class="pt-4 pb-2">
        <h5 class="text-muted">Vídeo Historia de Vida</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="col-md-8 mx-auto">
    <video width="1080" height="720" controls autoplay>
        <source src={{$path}} type="video/mp4">
    </video> 
</div>
    {{-- <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src={{$path}} allowfullscreen></iframe>
    </div> --}}
    <div class="text-center">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
    </div>
</div>



@endsection


@push('scripts')
    @include('layouts.scripts')
@endpush
