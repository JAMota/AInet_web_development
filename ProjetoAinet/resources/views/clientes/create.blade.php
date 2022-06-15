@extends('layout_admin')
@section('title', 'Novo Cliente')
@section('content')
    <form method="POST" action="{{ route('clientes') }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('clientes.partials.create-edit')



            <label for="nif" class="col-md-4 col-form-label text-md-end">{{ __('Nif') }}</label>


                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror"
                    name="nif" value="{{ old('nif') }}" required autocomplete="nif" autofocus>


                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="inputVisa" name="tipo_pagamento" value="VISA"
                        {{ old('tipo_pagamento', $cliente->tipo_pagamento) == 'VISA' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inputVisa"> VISA </label>
                    <input type="radio" class="form-check-input ml-4" id="inputMBWay" name="tipo_pagamento" value="MBWAY"
                        {{ old('tipo_pagamento', $cliente->tipo_pagamento) == 'MBWAY' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inputMBWay"> MBWAY </label>
                    <input type="radio" class="form-check-input ml-4" id="inputMBWay" name="tipo_pagamento" value="PAYPAL"
                        {{ old('tipo_pagamento', $cliente->tipo_pagamento) == 'PAYPAL' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inputMBWay"> PAYPAL </label>
                </div>

                <div class="form-group">
                    <label for="inputGabinete">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword">
                    @error('password')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="inputCPassword">Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="inputCPassword">
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        {{ route('clientes')  }}
                    </button>
                    <a href="{{ route('clientes') }}" class="btn btn-secondary">Cancel</a>
                </div>

    </form>
@endsection
