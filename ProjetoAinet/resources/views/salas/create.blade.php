@extends('layout_admin')
@section('title', 'Novo Sala' )
@section('content')
    <form method="POST" action="{{route('admin.salas.store')}}" class="form-group">
        @csrf
        @include('salas.partials.create-edit')
        <div class="form-group text-right">

                <button type="submit" class="btn btn-primary" href="{{route('admin.salas.create')}}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{ route('admin.salas') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
