<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div class="row m-2">
    <div class="col-md-12">
        <h3>
            Todos os Filmes | Filmes cujo título inclui "abc" | Filmes de "Ação || Filmes de "Ação" cujo título inclui "xpto"
        </h3>
    </div>
</div>

<div class="row m-2">
    <form method="get" action="#" class="d-flex flex-fill flex-md-row flex-column">
        <div class="flex-grow-1 pr-0 pr-md-3">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Título</span>
                    </div>
                    <input type="text" name="titulo" class="form-control">
                </div>
            </div>
        </div>
        <div class="flex-grow-1 pr-0 pr-md-3">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Género</span>
                    </div>
                    <select name="genero" class="custom-select">
                        <option value="">Todos géneros</option>
                        <option value="codigo_genero_a">Género A</option>
                        <option value="codigo_genero_b" selected>Género B</option>
                        <option value="codigo_genero_c">Género C</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="btn-group" role="group">
                <a href="#" class="btn btn-secondary px-4">Limpar</a>
                <button type="submit" class="btn btn-success px-4">Pesquisar</button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <!-- REPETIR PARA CADA LIVRO DO CATÁLOGO -->
    <div class="col-sm-12 col-lg-6">
        <div class="card shadow-sm sm-4 mb-4 flex-row">
            <img src="url_da_imagem_da_capa" class="bd-placeholder-img card-img-left w-25 h-25 m-2">
            <div class="card-body d-flex flex-column">
                <h3>Título do livro</h3>
                <h5>Nome do género</h5>
                <p class="card-text">Descrição do Livro</p>
                <div class="text-center mt-auto d-flex justify-content-center">
                    <h5 class="mx-2 pt-2">23,45 €</h5>

                    <!-- Só mostra se utilizador for CLIENTE -->
                    @can('cliente')
                    <div class="mx-2">
                        <div class="text-center">
                            <form method="post" action="#">
                                <button class="btn btn-primary">Comprar</button>
                            </form>
                        </div>
                    </div>
                    <!-- FIM - Só mostra se utilizador for CLIENTE -->

                    <!-- Só mostra se utilizador for FUNCIONÁRIO -->
                    <div class="mx-2">
                        <div class="text-center">
                            <form method="post" action="#">
                                <button class="btn btn-danger">Apagar</button>
                                <a href="#" class="btn btn-primary">Alterar</a>
                            </form>
                        </div>
                    </div>
                    <!-- FIM - Só mostra se utilizador for FUNCIONÁRIO -->
                </div>
            </div>
        </div>
    </div>
    <!-- FIM DE REPETIR PARA CADA ITEM DO CATÁLOGO -->
</div>
