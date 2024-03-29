<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="/img/logo.png" alt="Logo" class="logo-img">
                </div>
                <div class="sidebar-brand-text mx-3">DEI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">





            <!-- Nav Item -->
            @can('viewAny', App\Models\Cliente::class)
                @if (auth()->user()->tipo == 'A')
                    <li class="nav-item {{ Route::currentRouteName() == 'admin.clientes' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.clientes') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Gestão de Clientes</span></a>
                    </li>
                @endif
            @endcan

            <!-- Nav Item -->

            @auth @if (auth()->user()->tipo == 'A')
                <li class="nav-item {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Gestão de Trabalhadores</span></a>
                </li>
            @endif @endauth


            <!-- Nav Item -->
            @can('viewAny', App\Models\User::class)
                <li class="nav-item {{ Route::currentRouteName() == 'users' ? 'bloqueado' : '' }}">
                    <a class="nav-link" href="{{ route('users') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Utilizadores</span>
                    </a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Parte Publica</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            <!-- Nav Item - Generos -->
            @auth @if (auth()->user()->tipo == 'A')
                <li class="nav-item {{ Route::currentRouteName() == 'admin.generos' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.generos') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Gestao de Generos</span></a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider">
            @endif
        @endauth

        <!-- Nav Item - Salas -->
        @auth @if (auth()->user()->tipo == 'A')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.salas' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.salas') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestao de Salas</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
        @endif @endauth

        <!-- Nav Item - Filmes -->
        @auth @if (auth()->user()->tipo == 'A')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.filmes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.filmes') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestao de Filmes</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">
        @endif @endauth
        <!-- Nav Item - Salas -->
        @auth @if (auth()->user()->tipo == 'A')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.lugares' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.lugares') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestao de Lugares</span></a>
            </li>
        @endif @endauth

        <!-- Nav Item - Preços -->
        @auth @if (auth()->user()->tipo == 'A')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.configuracao.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.configuracao.edit') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestao de Preço</span></a>
            </li>
        @endif @endauth

        <!-- Nav Item - Preços -->
        @auth @if (auth()->user()->tipo == 'F')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.configuracao.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.configuracao.edit') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestao de Preço</span></a>
            </li>
        @endif @endauth

        <!-- Nav Item - Bilhetes -->
        @auth @if (auth()->user()->tipo == 'C')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.bilhetes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.bilhetes') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bilhetes</span></a>
            </li>
        @endif @endauth

        <!-- Nav Item - Recibos -->
        @auth @if (auth()->user()->tipo == 'C')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.recibos' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.recibos') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Recibos</span></a>
            </li>
        @endif @endauth

        <!-- Divider -->
        <hr class="sidebar-divider">




    </ul>


    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_img.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (auth()->user()->tipo == 'C')
                                    <a class="dropdown-item"
                                        href="{{ route('admin.clientes.edit', auth()->user()->cliente) }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item" href="{{ route('admin.password.edit') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Alterar Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    @endguest
                </ul>


            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @if (session('alert-msg'))
                    @include('partials.message')
                @endif
                @if ($errors->any())
                    @include('partials.errors-message')
                @endif

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Departamento de Engenharia Informática 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


</body>

</html>
