<div class="form-group">
    <label for="inputTitle">Titulo</label>
     <input type="text" class="form-control" name="titulo" id="inputTitle" value="{{old('titulo', $filme->titulo)}}" />
       @error('titulo')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputSum">Sumario</label>
     <input type="text" class="form-control" name="sumario" id="inputSum" value="{{old('sumario', $filme->sumario)}}" />
       @error('sumario')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>


   <div class="form-group">
     <label for="inputGeneroTitulo">Genero_Titulo</label>
     <select class="form-control" name="genero_code" id="inputGeneroTitulo">
         @foreach ($generos as $genero)
           <option value="{{$genero->code}}"
             {{ old('genero_code', $filme->genero_code) == $genero->code ? 'selected' : ''}}>{{$genero->nome}}</option>
         @endforeach
     </select>
       @error('curso')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputNome">Ano</label>
    <input type="text" class="form-control" name="ano" id="inputAno" value="{{old('ano', $filme->ano)}}" />
      @error('ano')
          <div class="small text-danger">{{$message}}</div>
      @enderror
  </div>

   <div class="form-group">
    <label for="inputNome">Trailer url</label>
    <input type="text" class="form-control" name="trailer_url" id="inputTrailerUrl" value="{{old('trailer_url', $filme->trailer_url)}}" />
      @error('trailer_url')
          <div class="small text-danger">{{$message}}</div>
      @enderror
  </div>

  <div class="form-group">
    <label for="inputFoto">Upload do cartaz</label>
    <input type="file" class="form-control" name="cartaz_url" id="inputCartazUrl" >
    @error('cartaz_url')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>


   <!-- Falta trailer_url, cartaz_url -->


