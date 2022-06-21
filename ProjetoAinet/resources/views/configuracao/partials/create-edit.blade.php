

<div class="form-group">
    <label for="inputPercentagemIva">Percentagem iva</label>
    <input type="text" class="form-control" name="percentagem_iva" id="percentagem_iva" value="{{old('nome', $configuracao->percentagem_iva)}}" >
    @error('percentagem_iva')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPrecoBilheteSemIva">Preço bilhete sem iva</label>
    <input id="preco_bilhete_sem_iva" type="text" class="form-control @error('preco_bilhete_sem_iva') is-invalid @enderror" name="preco_bilhete_sem_iva"
        value="{{ old('nif', $configuracao->preco_bilhete_sem_iva) }}" required autocomplete="nif" autofocus>
        @error('preco_bilhete_sem_iva')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
    </div>
