@extends('layout_admin')
@section('title', 'Alterar Filme')
@section('content')

    <form method="POST" action="{{route('admin.filmes.update',['filme' => $filme])}}" class="form-group">
        @csrf
        @method('PUT')
        @include('filmes.partials.create-edit')
        <div class="form-group text-right" enctype="multipart/form-data">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('admin.filmes.edit',['filme' => $filme])}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
