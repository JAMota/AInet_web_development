
<div class="form-group">
    <label for="inputSala">Sala</label>
    <input type="text" class="form-control" name="sala" id="inputSala" value="{{old('sala', $lugar->sala_id)}}" >
    @error('sala')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputFila">Fila</label>
    <input type="text" class="form-control" name="fila" id="inputFila" value="{{old('nome', $lugar->fila)}}" >
    @error('fila')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputPosicao">Posicao</label>
    <input type="text" class="form-control" name="posicao" id="inputPosicao" value="{{old('posicao', $lugar->posicao)}}" >
    @error('posicao')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

