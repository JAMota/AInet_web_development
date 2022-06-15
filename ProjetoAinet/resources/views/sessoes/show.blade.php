@extends('layout')

@section('header_bottom')

@section('content')
    <div class="content_top">
        <div class="heading">
            <h3>Sessao das {{ $sessao->data }} {{ $sessao->horario_inicio }}</h3>
        </div>
    </div>
    <div class="section group">
        <div class='d-flex'>

            <div class="cartaz images_1_of_5">

                <a href="#"><img src="{{ asset('storage/cartazes/' . $sessao->filme->cartaz_url) }}" alt=""
                        class="cartaz_url" /></a>
                <h2 class="cartaz_titulo"><a href="{{ $sessao->filme->trailer_url }}">{{ $sessao->filme->titulo }}</a>
                </h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees">{{ $sessao->filme->ano }}</span></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div>
            <h3>Lugares</h3>
            @foreach ($filas as $fila)
                {{ $fila }}<br>
                @foreach ($lugares as $lugar)
                    @if ($fila == $lugar->fila)
                        @if ($sessao->bilhetes()->where('lugar_id', $lugar->id)->count())
                            <button class="ocupado" type="button" disabled>{{ $lugar->posicao }}</button>
                        @else
                            <form action="" method="post" class="d-inline">
                                <button class="livre" type="submit">{{ $lugar->posicao }}</button>
                            </form>
                        @endif
                    @endif
                @endforeach
                <br>
            @endforeach
        </div>
    </div>
@endsection
