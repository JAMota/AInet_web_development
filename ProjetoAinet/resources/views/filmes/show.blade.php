@extends('layout')

@section('header_bottom')

@section('content')
    <div class="content_top">
        <div class="heading">
            <h3>Filme</h3>
        </div>
    </div>
    <div class="section group">
        <div class='d-flex'>

                <div class="cartaz images_1_of_5">

                    <a href="#"><img src="{{ asset('storage/cartazes/' . $filme->cartaz_url) }}" alt=""
                            class="cartaz_url" /></a>
                    <h2 class="cartaz_titulo"><a href="{{ $filme->trailer_url }}">{{ $filme->titulo }}</a></h2>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="rupees">{{ $filme->ano }}</span></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
        </div>
        <div><h3>Sessoes</h3>
                @foreach ($sessoes as $sessao)
                    {{$sessao->data}} {{$sessao->horario_inicio}} <a href="{{route('sessoes.show', ['sessao'=>$sessao])}}">Lugares</a><br>

                @endforeach
        </div>
    </div>
@endsection
