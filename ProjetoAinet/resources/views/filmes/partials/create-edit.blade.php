<div class="form-group">
    <label for="inputTitle">Titulo</label>
     <input type="text" class="form-control" name="titulo" id="inputTitle" value="{{old('titulo', $filme->titulo)}}" />
       @error('titulo')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
    <label for="inputSum">Sumario</label>
     <input type="text" class="form-control" name="sumario" id="inputSum" value="{{old('sumario', $filme->titulo)}}" />
       @error('sumario')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
     <label for="inputNome">Nome</label>
     <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $filme->nome)}}" />
       @error('nome')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
     <label for="inputGeneroTitulo">Genero_Titulo</label>
     <select class="form-control" name="genero_titulo" id="inputGeneroTitulo">
         @foreach ($genero_titulo as $genero_titulo)
           <option value="{{$genero_titulo->titulo}}"
             {{ old('genero_titulo', $filme->genero_titulo) == $genero_titulo->titulo ? 'selected' : ''}}>{{$genero_titulo->nome}}</option>
         @endforeach
     </select>
       @error('curso')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <div class="form-group">
     <div>Ano</div>
     <div class="form-check form-check-inline">
       <input type="hidden" name="ano" value="">
       <input type="radio" class="form-check-input" id="inputAno1" name="ano" value="1"
       {{ old('ano', $filme->ano) == 1 ? 'checked' : '' }}>
       <label class="form-check-label" for="inputAno1"> 1 </label>
       <input type="radio" class="form-check-input ml-4" id="inputAno2" name="ano" value="2" {{ old('ano', $filme->ano) == 2 ? 'checked' : '' }}>
       <label class="form-check-label" for="inputAno2"> 2 </label>
       <input type="radio" class="form-check-input ml-4" id="inputAno3" name="ano" value="3" {{ old('ano', $filme->ano) == 3 ? 'checked' : '' }}>
       <label class="form-check-label" for="inputAno3"> 3 </label>
     </div>
       @error('ano')
           <div class="small text-danger">{{$message}}</div>
       @enderror
   </div>

   <!-- Falta trailer_url, cartaz_url -->


