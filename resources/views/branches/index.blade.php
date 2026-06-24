
@extends('adminlte::page')

@section('content_header')
    <h1>Compañias</h1>
@stop

@section('content')

<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-companias')
            <a href="{{ route('branches.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id ="compania">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Permiso</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($branches as $branch)
                <tr>
                   <th scope="row">{{ $loop->iteration }}</th>
                   <td>{{ $branch->name }}</td>
                   <td>
                        <form action="{{ route('branches.destroy', $branch->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('branches.show', $branch->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>

                                @can('editar-companias')
                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('eliminar-companias')
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

<script type="text/javascript">

$(document).ready(function() {

    var table = $('#compania').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
         }


    });
});
</script>


@endsection

