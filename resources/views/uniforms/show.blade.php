@extends('adminlte::page')

@section('content_header')
    <h1>Ver Uniforme</h1>
@stop

@section('content')



    <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Uniforme
                </div>
                <div class="float-right">
                    <a href="{{ route('uniforms.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $uniform->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-right text-left"><strong>Estado:</strong></label>
                        <div class="col-md-6 pt-2">
                            @if ($uniform->status)
                                <span class="text-success">Activo</span> <!-- O puedes usar un ícono -->
                            @else
                                <span class="text-danger">Inactivo</span> <!-- O puedes usar un ícono -->
                            @endif

                       </div>
                   </div>

                   <!--Detalle-->
                   <div class="card card-info">
                            <div class="card-header">
                                    <h3 class="card-title">Detalle</h3>
                            </div>
                                <div class="card-body" id ='detalles'>

                                    <table class="table table-striped dataTable table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>Talla</th>
                                                <th>Existencia</th>
                                                <th>Salidas</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($uniform->levels as $level)
                                                <tr>
                                                    <td>{{ $level->size }}</td>
                                                    <td>{{ $level->existence }}</td>
                                                    <td>{{ $level->departure }}</td>
                                                    <td>{{ $level->existence-$level->departure }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                    </div>

            </div>



</div>


@endsection
