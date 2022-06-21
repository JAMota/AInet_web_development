@extends('layout_admin')
@section('title','Alterar Lugar' )
@section('content')
    <form method="POST" action="{{ route('admin.lugares.update', ['lugar' => $lugar]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('lugares.partials.create-edit')

        <div class="form-group text-right">

                <button type="submit" class="btn btn-success" href="{{ route('admin.lugares.edit', ['lugar' => $lugar]) }}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{route('admin.lugares') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
