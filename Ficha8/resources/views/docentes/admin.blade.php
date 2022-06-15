
@extends('layout_admin')
@section('title','Docentes' )
@section('content')
<div class="row mb-3">
    <div class="col-3">
        @can('create', App\Models\Docente::class)
        <a href="{{route('admin.docentes.create')}}" class="btn btn-success" role="button" aria-pressed="true">Novo Docente</a>
        @endcan
    </div>
    <div class="col-9">
        <form method="GET" action="{{route('admin.docentes')}}" class="form-group">
            <div class="input-group">
            <select class="custom-select" name="departamento" id="inputDepartamento" aria-label="Departamento">
                <option value="" {{'' == old('departamento', $departamento) ? 'selected' : ''}}>Todos Departamentos</option>
                @foreach ($departamentos as $abr => $nome)
                <option value={{$abr}} {{$abr == old('departamento', $departamento) ? 'selected' : ''}}>{{$nome}}</option>
                @endforeach
            </select>
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
                <th>Departamento</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr {{$docente->user->admin ? 'class=table-success' : ''}}>
                    <td>
                        <img src="{{$docente->user->url_foto ? asset('storage/fotos/' . $docente->user->url_foto) : asset('img/default_img.png') }}" alt="Foto do docente"  class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{$docente->user->name}}</td>
                    <td>{{$docente->departamentoRef->nome}}</td>
                    <td nowrap>
                        @can('view',$docente)
                        <a href="{{ route('admin.docentes.edit', ['docente' => $docente]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i
                                class="fa @cannot('update',$docente) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                                <span class="btn btn-secondary btn-sm disabled"><i
                                    class="fa @cannot('update',$docente) fa-eye @else fa-pen @endcan"></i></span>

                        @endcan
                        @can('delete',$docente)
                        <form action="{{route('admin.docentes.destroy', ['docente' => $docente])}}" method="POST" class="d-inline"
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
    {{ $docentes->withQueryString()->links() }}
@endsection

