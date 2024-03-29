@extends('layout_admin')
@section('title', 'Alterar User')
@section('content')
    <form method="POST" action="{{ route('admin.users.update', ['user' => $user]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
        @include('users.partials.create-edit')
        @isset($user->foto_url)
            <div class="form-group">
                <img src="{{ $user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
                    alt="Foto do user" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($user->foto_url)
                @can('update', $user)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $user)
                <button type="submit" class="btn btn-primary" href="{{ route('admin.users.edit', ['user' => $user]) }}">
                    <a> Save</a>
               </button>

               </button>
               <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
            @endcan
    </div>
    </form>
    <form id="form_delete_photo" action="{{ route('admin.users.foto.destroy', ['user' => $user]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
