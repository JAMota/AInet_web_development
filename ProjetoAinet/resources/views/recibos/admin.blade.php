@extends('layout_admin')
@section('title', 'Receibos')
@section('content')
    <div class="row mb-3">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Receibo</th>
                <th>Preço</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recibos as $recibo)
                <tr>


                    @if ($recibo->cliente_id == auth()->user()->id)
                        <td>{{ $recibo->id }}</td>
                        <td>{{ $recibo->preco_total_com_iva }}</td>
                        <td nowrap>
                    @endif




                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
