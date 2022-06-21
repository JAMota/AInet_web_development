@extends('layout_admin')
@section('title', 'Bilhetes')
@section('content')
    <div class="row mb-3">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Bilhete</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bilhetes as $bilhete)
                <tr>
                    <td>{{ $bilhete->id }}</td>
                    <td>{{ $bilhete->estado }}</td>
                    <td nowrap>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
