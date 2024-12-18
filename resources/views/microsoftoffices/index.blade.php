@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Licencia office</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Licencia office</a></li>

                    </ol>
                </div>
                </div>
            </div>
</section>

<div class="card card-info card-outline">

    <div class="card-body">
       @can('crear-marcas')
            <a href="{{ route('microsoftoffices.create')}}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
                     @if(session('success'))
                        <div class="alert alert-success" id='success-message'>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('errors'))
                        <div class="alert alert-danger" id='success-message'>
                            {{ session('errors') }}
                        </div>
                    @endif

        <table class="table table-striped dataTable table-bordered"  id ="office">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Office</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    $('#office').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('microsoftoffices.pagination') }}",
                type: "GET",
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

       setTimeout(function() {
            $('#success-message').fadeOut('slow');

        }, 1500); // Cambiar 5000 por el número de milisegundos que desees

});
</script>

@endsection

