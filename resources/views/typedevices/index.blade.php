@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipos de Dispositivos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Tipos de Dispositivos</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>
<div class="card card-info card-outline">
    <div class="card-body">
         @can('crear-tipodispositivos')
            <a href="{{ route('typedevices.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id ="tabledatatypedevice">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>
            <tbody>
               @forelse ($typedevices as $typedevice)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $typedevice->name }}</td>
                    <td>
                            <form action="{{ route('typedevices.destroy', $typedevice->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('typedevices.show', $typedevice->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>

                                    @can('editar-tipodispositivos')
                                        <a href="{{ route('typedevices.edit', $typedevice->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    @endcan

                                    @can('eliminar-tipodispositivos')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Esta seguro de eliminar el tipo de dispositivo?');"><i class="fas fa-trash"></i> Eliminar</button>
                                    @endcan


                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="5">
                        <span class="text-danger">
                            <strong>No User Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
       </table>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    var table = $('#tabledatatypedevice').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
         }


    });
});
</script>

@endsection
