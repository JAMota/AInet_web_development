<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>

<head>
    <title>Free Movies Store Website Template | Home :: w3layouts</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.9.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.nivo.slider.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider();
        });
    </script>
</head>

<body>
    <div class="header">
        <div class="headertop_desc">
            <div class="wrap">
                <div class="nav_list">
                    <ul>
                        <li><a href="/">Filmes em Cartaz</a></li>
                    </ul>
                </div>
                <div class="account_desc">
                    <ul>

                        @auth
                            @if (auth()->user()->tipo != 'C')
                                <li><a href="{{ route('login') }}">Dashboard</a></li>
                            @endif
                        @else<li><a href="{{ route('registo') }}">Registo</a></li>

                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endauth

                        <li><a href="{{ route('carrinho.index') }}">Carrinho</a></li>
                        @auth
                            @if (auth()->user()->tipo == 'C')
                                <li><a href="{{ route('admin.clientes.edit', auth()->user()->cliente) }}">Minha conta</a>
                                </li>
                            @endauth
                        @endauth
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="cart">
                    <p><span>Cart</span>
                    <div id="dd" class="wrapper-dropdown-2"> (empty)
                        <ul class="dropdown">
                            <li>you have no items in your Shopping cart</li>
                        </ul>
                    </div>
                    </p>
                </div>
                <div class="search_box">
                    <!--<form>
                    <input type="text" class="form-control filter-input" placeholder="procurar titulo" data-column=3><input type=submit>
                </form>-->
                    <!--<form action="{#{ route('search') }}" method="GET">
                        <input type="text" name="search" required />
                        <button type="submit">Search</button>
                    </form>

                    @#if ($posts->isNotEmpty())
                        @#foreach ($posts as $post)
                            <div class="post-list">
                                <p>{#{ $post->titulo }}</p>
                                <img src="{#{ $post->image }}">
                            </div>
                        @#endforeach
                    @#else
                        <div>
                            <h2>No posts found</h2>
                        </div>
                    @#endif-->

                </div>

                <div class="clear"></div>
            </div>
            <script type="text/javascript">
                function DropDown(el) {
                    this.dd = el;
                    this.initEvents();
                }
                DropDown.prototype = {
                    initEvents: function() {
                        var obj = this;

                        obj.dd.on('click', function(event) {
                            $(this).toggleClass('active');
                            event.stopPropagation();
                        });
                    }
                }

                $(function() {

                    var dd = new DropDown($('#dd'));

                    $(document).click(function() {
                        // all dropdowns
                        $('.wrapper-dropdown-2').removeClass('active');
                    });

                });
            </script>
            <div class="clear"></div>
        </div>
        <div class="header_bottom">
            @yield('header_bottom')
        </div>
    </div>
</div>
<!------------End Header ------------>
<div class="main">
    <div class="wrap">
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<div class="footer">
    <div class="copy_right">
        <p>Company Name © All rights Reseverd | Design by <a href="http://w3layouts.com">W3Layouts</a> </p>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>

</html>
