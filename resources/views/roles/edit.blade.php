@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rol</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Rol</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card car-info">
            <div class="card-header">
                <div class="float-start">
                    Editar Rol
                </div>
                <div class="float-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $role->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Permisos</label>
                        <div class="col-md-6  form-group">
                        <select class="form-control select2 @error('permissions') is-invalid @enderror "  multiple  aria-label="permissions" id="permissions" name="permissions[]">
                                @forelse ($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions ?? []) ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                            @if ($errors->has('permissions'))
                                <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar Rol">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
{
    multiple: true,
}

    );
});

</script>
@endsection
