<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome"
        value="{{ old('name', $cliente->user->name) }}">
    @error('name')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputNif">Nif</label>
    <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif"
        value="{{ old('nif') }}" required autocomplete="nif" autofocus>
    @error('nif')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="inputTipoPagamento">Tipo de Pagamento</label>
</div>
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
    @error('tipo_pagamento')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputRefPagamento">Referencias de Pagamento</label>
    <input id="ref_pagamento" type="text" class="form-control @error('ref_pagamento') is-invalid @enderror"
        name="ref_pagamento" value="{{ old('ref_pagamento') }}" required autocomplete="ref_pagamento" autofocus>
    @error('ref_pagamento')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
