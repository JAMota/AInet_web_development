@extends('layout_admin')
@section('title','Alunos' )
@section('content')
<div class="row mb-3">
    <div class="col-3">
        @can('create', App\Models\Aluno::class)
            <a  href="{{route('admin.alunos.create')}}" class="btn btn-success" role="button" aria-pressed="true">Novo Aluno</a>
        @endcan
    </div>
    <div class="col-9">
        <form method="GET" action="{{route('admin.alunos')}}" class="form-group">
            <div class="input-group">
            <select class="custom-select" name="curso" id="inputCurso" aria-label="Curso">
                <option value="" {{'' == old('curso', $curso) ? 'selected' : ''}}>Todos Cursos</option>
                @foreach ($cursos as $abr => $nome)
                <option value={{$abr}} {{$abr == old('curso', $curso) ? 'selected' : ''}}>{{$nome}}</option>
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
                <th>Nº</th>
                <th>Nome</th>
                <th>Curso</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                <tr>
                    <td>
                        <img src="{{$aluno->user->url_foto ? asset('storage/fotos/' . $aluno->user->url_foto) : asset('img/default_img.png') }}" alt="Foto do aluno"  class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{$aluno->numero}}</td>
                    <td>{{$aluno->user->name}}</td>
                    <td>{{$aluno->cursoRef->nome}}</td>
                    <td nowrap>
                        @can('view', $aluno)
                        <a href="{{ route('admin.alunos.edit', ['aluno' => $aluno]) }}"
                            class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i
                                class="fa  @cannot('update',$aluno) fa-eye @else fa-pen @endcan"></i></a>
                        @else
                        <span class="btn btn-secondary btn-sm disabled"><i
                            class="fa @cannot('update',$aluno) fa-eye @else fa-pen @endcan"></i></span>
                        @endcan
                        @can('delete', $aluno)
                        <form action="{{route('admin.alunos.destroy', ['aluno' => $aluno])}}" method="POST" class="d-inline"
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
    {{ $alunos->withQueryString()->links() }}
@endsection

