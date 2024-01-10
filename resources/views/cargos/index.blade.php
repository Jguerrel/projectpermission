
@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cargos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Cargos</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <!-- <div class="card-header">Cargos</div> -->

    <div class="card-body">
       @can('create-cargo')
            <a href="{{ route('cargos.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id='cargos'>
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Permiso</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cargos as $cargo)
                <tr>
                   <th scope="row">{{ $loop->iteration }}</th>
                   <td>{{ $cargo->name }}</td>
                   <td>
                        <form action="{{ route('cargos.destroy', $cargo->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('cargos.show', $cargo->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>

                                @can('edit-cargo')
                                    <a href="{{ route('cargos.edit', $cargo->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('delete-cargo')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="fas fa-trash"></i> Eliminar</button>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    var table = $('#cargos').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
         }


    });
});
</script>


@endsection

