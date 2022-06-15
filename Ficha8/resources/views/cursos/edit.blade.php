@extends('layout_admin')
@section('title','Alterar Curso' )
@section('content')
    <form method="POST" action="{{route('admin.cursos.update', ['curso' => $curso]) }}" class="form-group">
        @csrf
        @method('PUT')
        @include('cursos.partials.create-edit')
        <input type="hidden" name="curso_abreviatura" value="{{$curso->abreviatura}}">
        <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.cursos.edit', ['curso' => $curso]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
