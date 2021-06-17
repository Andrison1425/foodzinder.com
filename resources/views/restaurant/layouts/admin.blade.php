<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('plantilla/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('plantilla/img/img-compartir.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('plantilla/img/img-compartir.png')}}">
    <!-- Bootstrap core CSS-->
    <link href="{{asset('plantilla/admin_section/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{asset('plantilla/admin_section/css/admin.css')}}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{asset('plantilla/admin_section/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('plantilla/css/icons.css')}}">
    <!-- Plugin styles -->
    <link href="{{asset('plantilla/admin_section/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <!-- Your custom styles -->
    <link href="{{asset('plantilla/admin_section/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- VUEJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <style>
        .nav-opc-admin{
            font-size: 14px;
            color:white !important;
        }

        .nav-opc-admin i{
            margin-right: 3px;
        }
    </style>

    @yield('custom-links')
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->

@if (session('Notificacion'))
        <!-- Modal -->
    <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{session('Notificacion')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

@endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('plantilla/img/logo.svg')}}" data-retina="true" alt="logo" width="142" height="36"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tablero">
                    <a class="nav-link nav-opc-admin" href="{{route('restaurant.index')}}">
                        <!-- <i class="fa fa-fw fa-dashboard"></i> -->
                        <span class="nav-link-text">Tablero</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
                    <a class="nav-link nav-opc-admin" href="{{route('restaurant.listado')}}">
                    <!-- <i class="fa fa-fw fa-plus-circle"></i> -->
                        <span class="nav-link-text">Restaurantes</span>
                    </a>
                    <ul style="list-style:none;">
                        <li>
                            <a class="nav-link nav-opc-admin" href="{{route('restaurant.create')}}">
                                Añadir Nuevo
                            </a>
                        </li>
                        <li>
                            <a class="nav-link nav-opc-admin" href="{{route('restaurant.listadoPrioridad')}}">
                                Ordenar
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bookings">
                    <a class="nav-link nav-opc-admin" href="{{route('users.index')}}">
                        <!-- <i class="fa fa-fw fa-list"></i> -->
                        <span class="nav-link-text">Usuarios</span>
                    </a>
                    <ul style="list-style:none;">
                        <li>
                            <a class="nav-link nav-opc-admin" href="{{route('users.agregar')}}">
                                Añadir usuario
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bookings">
                    <a class="nav-link nav-opc-admin" href="{{route('directorio')}}">
                        <!-- <i class="fa fa-fw fa-list"></i> -->
                        <span class="nav-link-text">Ir al directorio</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                       <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link nav-opc-admin" data-toggle="modal" data-target="#logout">
                        <!-- <i class="fa fa-fw fa-sign-out"></i> -->
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Navigation-->
    <div class="content-wrapper" id="app">
        @yield('content')
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Foodzinder 2021</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutLabel">¿Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Cerrar sesión</button>
				    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plantilla/admin_section/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('plantilla/admin_section/vendor/chart.js/Chart.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/jquery.selectbox-0.2.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/retina-replace.min.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/jquery.magnific-popup.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('plantilla/admin_section/js/admin.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{asset('plantilla/admin_section/js/admin-charts.js')}}"></script>
    @yield('scripts')

    <script>
        $("#modalMensaje").modal('show');
    </script>
</body>

</html>
