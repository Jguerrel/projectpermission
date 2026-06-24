@extends('adminlte::page')

@section('content_header')
    <h1>Cuenta</h1>
@stop

@section('content')


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Editar Cuenta
                </div>
                <div class="float-right">
                    <a href="{{ route('accounts.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('accounts.update', $account->id) }}" method="post">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Cuenta</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $account->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Contraseña</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ $account->password }}">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Link</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ $account->link }}">
                                @if ($errors->has('link'))
                                    <span class="text-danger">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Descripcion</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $account->description }}">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Confirmar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
