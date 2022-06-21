@extends('layout')
@section('title','Filmes' )
@section('content')
<div class="row mb-3">
    <div class="col-9">
        <form method="GET" action="{{route('admin.filmes')}}" class="form-group">
            <div class="input-group">
            <input type="text" name="pesq_titulo" value="{{old('pesq_titulo',$pesq_titulo) }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Procurar</button>
            </div>
            </div>
        </form>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Genero</th>
            <th>Ano</th>
            <th>Cartaz</th>
            <th>Sumario</th>
            <th>Trailer</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($filmes as $filme)
            <tr>
                <td>{{ $filme->titulo }}</td>
                <td>{{ $filme->genero->nome }}</td>
                <td>{{ $filme->ano }}</td>
                <td><img src="{{ asset('storage/cartazes/' . $filme->cartaz_url) }}" alt="" class="img-profile" style="width:70px;height:70px"></td>
                <td>{{ $filme->sumario }}</td>
                <td><a href="{{ $filme->trailer_url }}">trailer</a></td>
                <td nowrap>

                    @can('view',$filme)
                    <a href="{{ route('admin.filmes.edit', ['filme' => $filme]) }}"
                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                        <i class="fas @cannot('update',$filme) fa-eye @else fa-pen @endcan"></i>
                    </a>
                    @else
                    <span class="btn btn-secondary btn-sm disabled"><i
                        class="fa @cannot('update',$filme) fa-eye @else fa-pen @endcan"></i></span>
                    @endcan
                    @can('delete',$filme)
                    <form action="{{route('admin.filmes.destroy',['filme' => $filme])}}" method="POST" class="d-inline"
                        onsubmit="return confirm('Tem a certeza que deseja apagar o registo?')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
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
{{ $filmes->withQueryString()->links() }}
@endsection
