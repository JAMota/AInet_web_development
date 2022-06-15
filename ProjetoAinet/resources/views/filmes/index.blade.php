@extends('layout')

@section('header_bottom')
    <div class="header_bottom_left">
        <div class="categories">
            <ul>
                <h3>Generos</h3>
                <li><a href="#">All</a></li>
                @foreach ($generos as $code => $nome)
                    <li><a href="#">{{ $nome }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="header_bottom_right">
        <!------ Slider ------------>
        <div class="slider">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    @foreach ($filmes as $filme)
                    <img  src="{{ asset('storage/cartazes/' . $filme->cartaz_url) }}" data-thumb="{{ asset('storage/cartazes/' . $filme->cartaz_url) }}" alt="" />
                    @endforeach
                </div>
            </div>
        </div>
        <!------End Slider ------------>
    </div>
    <div class="clear"></div>
@endsection
@section('content')
    <div class="content_top">
        <div class="heading">
            <h3>Filmes em Cartaz</h3>
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
