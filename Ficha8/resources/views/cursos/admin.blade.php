@extends('layout_admin')
@section('title', 'Cursos')
@section('content')
    <div class="row mb-3">
        @can('create', App\Models\Curso::class)
            <a href="{{ route('admin.cursos.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo Curso</a>
        @endcan
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Abreviatura</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Semestres</th>
                <th>ECTS</th>
                <th>Vagas</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->abreviatura }}</td>
                    <td>{{ $curso->nome }}</td>
                    <td>{{ $curso->tipo }}</td>
                    <td>{{ $curso->semestres }}</td>
                    <td>{{ $curso->ECTS }}</td>
                    <td>{{ $curso->vagas }}</td>
                    <td nowrap>
                        @can('view', $curso)
                        <a href="{{ route('admin.cursos.edit', ['curso' => $curso]) }}" class="btn btn-primary btn-sm"
                            role="button" aria-pressed="true"><i class="fa  @cannot('update',$curso) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$curso) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete',$curso)
                        <form action="{{ route('admin.cursos.destroy', ['curso' => $curso]) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Tem a certeza que deseja apagar o registo');">
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
@endsection
