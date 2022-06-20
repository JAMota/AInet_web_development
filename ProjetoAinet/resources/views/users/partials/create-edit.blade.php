
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" class="form-control" name="name" id="inputNome"
                value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail"
                value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputFoto">Upload da foto</label>
            <input type="file" class="form-control" name="foto_url" id="inputFoto">
            @error('foto')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div>
        <label for="inputTipo">Tipo de Utilizador</label>
        </div>
        <div class="form-check form-check-inline">

            <input type="radio" class="form-check-input" id="inputAdmin" name="tipo" value="A"
                {{ old('tipo', $user->tipo) == 'A' ? 'checked' : '' }}>
            <label class="form-check-label" for="inputAdmin"> Admin </label>

            <input type="radio" class="form-check-input ml-4" id="inputFuncionario" name="tipo" value="F"
                {{ old('tipo', $user->tipo) == 'F' ? 'checked' : '' }}>
            <label class="form-check-label" for="inputMBWay"> Funcionario </label>
            @error('tipo')
            <div class="small text-danger">{{ $message }}</div>
        @enderror
        </div>


