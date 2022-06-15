@extends('layout_admin')
@section('title', 'Alterar Docente')
@section('content')
    <form method="POST" action="{{ route('admin.docentes.update', ['docente' => $docente]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $docente->user_id }}">
        @include('docentes.partials.create-edit')
        @isset($docente->user->url_foto)
            <div class="form-group">
                <img src="{{ $docente->user->url_foto ? asset('storage/fotos/' . $docente->user->url_foto) : asset('img/default_img.png') }}"
                    alt="Foto do docente" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($docente->user->url_foto)
                @can('update', $docente)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $docente)
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{ route('admin.docentes.edit', ['docente' => $docente]) }}" class="btn btn-secondary">Cancel</a>
            @endcan
        </div>
    </form>
    <form id="form_delete_photo" action="{{ route('admin.docentes.foto.destroy', ['docente' => $docente]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
