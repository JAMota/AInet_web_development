@extends('layout')

@section('header_bottom')
    <div class="header_bottom_left">
        <div class="categories">
            <ul>
                <h3>Utilizadores</h3>
                <li><a href="#">All</a></li>
                @foreach ($users as $code => $name)
                    <li><a href="#">{{ $name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="header_bottom_right">
        <!------ Slider ------------
        <div class="slider">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    @foreach ($filmes as $user)
                    <img src="{{ asset('storage/cartazes/' . $user->foto_url) }}" data-thumb="{{ asset('storage/cartazes/' . $user->foto_url) }}" alt="" />
                    @endforeach
                </div>
            </div>
        </div>
        -----End Slider ------------>
    </div>
    <div class="clear"></div>
@endsection
@section('content')
    <div class="content_top">
    </div>
    <div class="section group">
        <div class='d-flex'>
            @foreach ($users as $user)
                <div class="cartaz images_1_of_5">

                    <a href="#"><img src="{{ asset('storage/cartazes/' . $user->foto_url) }}" alt=""
                            class="foto_url" /></a>
                    <h2 class="cartaz_titulo"><a href="{{ $user->trailer_url }}">{{ $user->titulo }}</a></h2>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="rupees">{{ $user->ano }}</span></p>
                        </div>
                        <div class="add-cart">
                            <h4><a href="#">Ver sessoes</a></h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
