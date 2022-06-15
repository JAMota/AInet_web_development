@extends('layout_admin')
@section('title','Clientes' )
@section('content')
<div class="row mb-3">

    <div class="col-9">
        <form method="GET" action="{{route('admin.clientes')}}" class="form-group">
            <div class="input-group">
            <input type="text" name="pesq_name" value="{{old('pesq_name',$pesq_name) }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </div>
            </div>
        </form>
    </div>
</div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>NIF</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>
                        <img src="{{$cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : asset('img/default_img.png') }}" alt="Foto do cliente"  class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>

                    <td>{{$cliente->user->name}}</td>
                    <td>{{$cliente->NIF}}</td>
                    <td nowrap>
                        @can('bloquear', $cliente->user)
                        <form action="{{route('admin.bloqueado.update', ['user' => $cliente->user])}}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem a certeza que deseja bloquear');">
                            @csrf
                            @method("patch")
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                class="fa  {{$cliente->user->bloqueado?'fa-lock':'fa-unlock'}}"></i></button>
                        </form>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa {{$cliente->user->bloqueado?'fa-lock':'fa-unlock'}}"></i></span>

                        @endcan
                        @can('view', $cliente)
                        <a href="{{ route('admin.clientes.edit', ['cliente' => $cliente]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i
                                class="fa  @cannot('update',$cliente) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$cliente) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete', $cliente)
                        <form action="{{route('admin.clientes.destroy', ['cliente' => $cliente])}}" method="POST" class="d-inline"
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
    {{ $clientes->withQueryString()->links() }}
@endsection

