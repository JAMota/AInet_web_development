@extends('layout_admin')
@section('title', 'Alterar Aluno')
@section('content')
    <form method="POST" action="{{ route('admin.alunos.update', ['aluno' => $aluno]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $aluno->user_id }}">
        @include('alunos.partials.create-edit')
        @isset($aluno->user->url_foto)
            <div class="form-group">
                <img src="{{ $aluno->user->url_foto ? asset('storage/fotos/' . $aluno->user->url_foto) : asset('img/default_img.png') }}"
                    alt="Foto do aluno" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($aluno->user->url_foto)
                @can('update', $aluno)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $aluno)
                 <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{ route('admin.alunos.edit', ['aluno' => $aluno]) }}" class="btn btn-secondary">Cancel</a>
            @endcan
    </div>
    </form>
    <form id="form_delete_photo" action="{{ route('admin.alunos.foto.destroy', ['aluno' => $aluno]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
