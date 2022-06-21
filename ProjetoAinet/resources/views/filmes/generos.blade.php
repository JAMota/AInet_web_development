@extends('layout')
@section('content')
    <div class="content_top">
        <div class="heading">
            <h3>Filmes</h3>
        </div>
    </div>
    <div class="section group">
        <div class='d-flex'>
            @foreach ($filmes as $filme)
                <div class="cartaz images_1_of_5">

                    <a href="#"><img src="{{ asset('storage/cartazes/' . $filme->cartaz_url) }}" alt=""
                            class="cartaz_url" /></a>
                    <h2 class="cartaz_titulo"><a href="{{ $filme->trailer_url }}">{{ $filme->titulo }}</a></h2>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="rupees">{{ $filme->ano }}</span></p>
                        </div>
                        <div class="add-cart">
                            <h4><a href="{{route('filmes.show',['filme'=>$filme])}}">Ver sessoes</a></h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
