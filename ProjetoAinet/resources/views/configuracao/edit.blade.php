@extends('layout_admin')
@section('title','Alterar Preços' )
@section('content')
    <form method="POST" action="{{route('admin.configuracao.update', ['configuracao' => $configuracao]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('configuracao.partials.create-edit')




        <div class="form-group text-right">

                <button type="submit" class="btn btn-success" href="{{route('admin.configuracao.edit', ['configuracao' => $configuracao]) }}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{route('home') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
