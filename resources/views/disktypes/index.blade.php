
@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipos de Discos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Tipos de Discos</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-tipodiscos')
            <a href="{{ route('disktypes.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered "  id ="tiposdiscos">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($disktypes as $disktype)
                <tr>
                   <th scope="row">{{ $loop->iteration }}</th>
                   <td>{{ $disktype->name }}</td>
                   <td>
                        <form action="{{ route('disktypes.destroy', $disktype->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('disktypes.show', $disktype->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>

                                @can('editar-tipodiscos')
                                    <a href="{{ route('disktypes.edit', $disktype->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>
                                @endcan

                                @can('eliminar-tipodiscos')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro de eliminar este tipo de disco?');"><i class="fas fa-trash"></i> Eliminar</button>
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

    $('#tiposdiscos').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('disktypes.pagination') }}",
                type: "GET",
                // success:function(data){
                //  alert(JSON.stringify(data))
                // },
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                     {data: 'status', name: 'status'},
                     {data: 'action', name: 'action', orderable: false},
                     
                 ],
                 order: [[0, 'desc']]
       });
});
</script>

@endsection

