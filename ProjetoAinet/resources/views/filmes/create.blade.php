@extends('layout_admin')
@section('title', 'Nova Filme')
@section('content')

    <form method="POST" action="{{route('admin.filmes.store')}}" class="form-group">
        @csrf
        @include('filmes.partials.create-edit')
        <div class="form-group text-right" enctype="multipart/form-data">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.filmes.create')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

@endsection
