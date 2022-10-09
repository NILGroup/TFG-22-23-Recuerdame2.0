@extends('layouts.structure')

@section('content')

<div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de sesiones</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href="/sesion/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>

        <div>
            <table class="table table-bordered recuerdameTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">Finalizada/No finalizada</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sesiones as $sesion)
                    <tr>
                        <th scope="row">{{$sesion->id}}</th>
                        <td><a href="{{route('sesion.show',$sesion->id)}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                        <td>{{$sesion->objetivo}}</td>
                        <td>{{$sesion->fecha_finalizada == null ? "" : $sesion->fecha_finalizada}}</td>
                        <td class="tableActions">
                            <a href="{{route('sesion.show',$sesion->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="{{route('sesion.update',$sesion->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            @if($sesion->fecha_finalizada != null)
                                <a href="{{route('sesion.show',$sesion->id)}}"><i class="fa-solid fa-file-circle-check text-success tableIcon"></i></a>
                            @else
                                <a href="{{route('sesion.update',$sesion->id)}}"><i class="fa-solid fa-file-circle-check text-success tableIcon"></i></a>
                            @endif

                            <a href="{{route('sesion.destroy',$sesion->id)}}"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
