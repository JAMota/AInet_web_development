@extends('layout_admin')
@section('title', 'Novo Genero' )
@section('content')
    <form method="POST" action="{{route('admin.generos.store')}}" class="form-group">

        @csrf
        <div class="form-group">
            <label for="inputAbr">Code</label>
            <input type="text" class="form-control" name="code" id="inputAbr" value="{{old('code', $genero->code)}}" >
            @error('code')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        @include('generos.partials.create-edit')
        <div class="form-group text-right">


                <button type="submit" class="btn btn-success" href="{{route('admin.generos.create')}}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{route('admin.generos') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
