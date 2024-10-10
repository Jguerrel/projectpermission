@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Roles</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <!-- <div class="card-header">Manage Roles</div> -->
    <div class="card-body">
        @can('crear-roles')
            <a href="{{ route('roles.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered datatable dtr-inline" id ="roles">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('roles.destroy', $role) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>

                            @if ($role->name!='Super Admin')
                                @can('editar-roles')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('eliminar-roles')
                                    @if ($role->name!=Auth::user()->hasRole($role->name))
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro que quieres eliminar este rol?');"><i class="fas fa-trash"></i> Eliminar</button>
                                    @endif
                                @endcan
                            @endif

                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>No Role Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $roles->links() }}

    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    var table = $('#roles').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
         }


    });
});
</script>

@endsection
