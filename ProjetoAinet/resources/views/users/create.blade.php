@extends('layout_admin')
@section('title', 'Novo Trabalhador')
@section('content')
    <form method="POST" action="{{ route('admin.trabalhadores.store') }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('users.partials.create-edit')

        <div class="form-group">
            <label for="inputGabinete">Password</label>
            <input type="password" class="form-control" name="password" id="inputPassword">
            @error('password')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="inputCPassword">Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="inputCPassword">
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary" href="{{ route('admin.trabalhadores.store') }}">
                 <a> Registar</a>
            </button>

            </button>
            <a href="{{ route('admin.trabalhadores') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
@endsection
