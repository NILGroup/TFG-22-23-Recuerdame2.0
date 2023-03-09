@extends('layouts.structure')

@section('content')

<div class="container-fluid" style="height: 80% !important">
<div class="pt-4 pb-2">
        <h5 class="text-muted">Video Historia de Vida</h5>
        <hr class="lineaTitulo">
    </div>
    <h1>{{$path}}</h1>
    <video width="320" height="240" controls autoplay><source src={{$path}} type="video/mp4"></video>

    <div class="text-center">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
    </div>
</div>



@endsection


@push('scripts')
    @include('layouts.scripts')
    <!--<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    -->
@endpush
