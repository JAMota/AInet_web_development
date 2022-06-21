@extends('layout_admin')
@section('title','Users' )
@section('content')
<div class="row mb-3">

    <div class="col-9">
        <form method="GET" action="{{route('admin.users')}}" class="form-group">
            <div class="input-group">
            <input type="text" name="tipo" value="{{old('tipo',$tipo) }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar por F ou A</button>
            </div>
            </div>
        </form>
    </div>
</div>

<div>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo Trabalhador</a>

</div>
<p> </p>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}" alt="Foto do utilizador"  class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>

                    <td>{{$user->name}}</td>

                    <td nowrap>
                        @can('bloquear', $user)
                        <form action="{{route('admin.bloqueado.update', ['user' => $user])}}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem a certeza que deseja bloquear');">
                            @csrf
                            @method("patch")
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                class="fa  {{$user->bloqueado?'fa-lock':'fa-unlock'}}"></i></button>
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa {{$user->bloqueado?'fa-lock':'fa-unlock'}}"></i></span>

                        @endcan
                        @can('view', $user)
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i
                                class="fa  @cannot('update',$user) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$user) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete', $user)
                        <form action="{{route('admin.users.destroy', ['user' => $user])}}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem a certeza que deseja apagar o registo');">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa fa-trash"></i></span>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->withQueryString()->links() }}
@endsection

