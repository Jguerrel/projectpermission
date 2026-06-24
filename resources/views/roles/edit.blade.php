@extends('adminlte::page')

@section('content_header')
    <h1>Rol</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Editar Rol
                </div>
                <div class="float-right">
                    <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left">Nombre</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $role->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="permissions" class="col-md-4 col-form-label text-md-right text-left">Permisos</label>
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
