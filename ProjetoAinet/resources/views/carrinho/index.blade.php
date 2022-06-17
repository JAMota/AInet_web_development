@extends('layout')
@section('content')


<div>
  <p>
        <form action="{{ route('carrinho.destroy') }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" value="Apagar carrinho">
        </form>
  </p>
  <p>
        <form action="{{ route('carrinho.store') }}" method="POST">
            @csrf
            <input type="submit" value="Confirmar carrinho">
        </form>
  </p>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Cartaz</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Sala</th>
            <th>Lugar</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($carrinho as $row)
    <tr>
        <td>{{ $row['titulo'] }} </td>
        <td>
            @if($row['cartaz_url'] )
            <img src="{{ asset('storage/cartazes/'.$row['cartaz_url']) }}" alt="">

            </td>
        <td>{{ $row['data'] }} </td>
        <td>{{ $row['horario_inicio'] }} </td>
        <td>{{ $row['sala'] }} </td>
        <td>{{ $row['lugar'] }} </td>


        <td>
            <form action="{{route('carrinho.destroy_bilhete', $row['id'])}}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" value="Remove">
            </form>

        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection
