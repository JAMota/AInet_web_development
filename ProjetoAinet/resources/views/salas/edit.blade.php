@extends('layout_admin')
@section('title','Alterar Sala' )
@section('content')
    <form method="POST" action="{{route('admin.salas.update', ['sala' => $sala]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('salas.partials.create-edit')
        <input type="hidden" name="sala_abreviatura" value="{{$sala->abreviatura}}">
        <div class="form-group text-right">

                <button type="submit" class="btn btn-primary" href="{{route('admin.salas.edit', ['sala' => $sala]) }}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{ route('admin.salas') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
