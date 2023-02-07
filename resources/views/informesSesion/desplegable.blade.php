<div class="accordion mb-2"> 
    <div class="accordion-item accordion-header" id="recuerdos1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#recuerdos" aria-expanded="true" aria-controls="evaluaciones">
            <div class="w-100">
                <h5 class="text-muted text-start">Modificar recuerdos</h5>
            </div>
        </button>
        
        <div id="tabla_recuerdos" class="tabla accordion-collapse collapse show mx-2" aria-labelledby="recuerdos1">
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
            </div>
            <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
                <thead>
                    <tr class="bg-primary">
                        <th scope="col" style="display: none;">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Etapa</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Etiqueta</th>
                        <th class="fit10" scope="col"></th>
                    </tr>
                </thead>
                <!--<tbody>-->
                @foreach($recuerdos as $recuerdo)
                <tr>
                    <td style="display: none;">{{$recuerdo->id}}</td>
                    <td>{{$recuerdo->nombre}}</td>
                    <td>{{{{date("d/m/Y", strtotime($recuerdo->fecha))}}</td>
                    <td>{{$recuerdo->etapa->nombre}}</td>
                    @if(!is_null($recuerdo->categoria))
                        <td>{{$recuerdo->categoria->nombre}}</td>
                    @else
                        <td>Sin categoría</td>
                    @endif
                    @if(!is_null($recuerdo->estado))
                        <td>{{$recuerdo->estado->nombre}}</td>
                    @else
                        <td>Sin estado</td>
                    @endif
                    @if(!is_null($recuerdo->etiqueta))
                        <td>{{$recuerdo->etiqueta->nombre}}</td>
                    @else
                        <td>Sin etiqueta</td>
                    @endif
                    <td class="tableActions">
                        <a onclick="actualizaModalRecuerdo({{$recuerdo->id}})" type="button" id="updateRecuerdo" name="updateRecuerdo" class="showmodal" data-bs-toggle="modal" data-bs-target="#recuerdosCreator"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>  
