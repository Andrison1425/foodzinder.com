<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Todos los menús de tus restaurantes en imágenes">
	 <meta name="author" content="Ansonika">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	 <title>Políticas de privacidad - Food Zinder</title>

	 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

	 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="plantilla/image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('plantilla/img/img-compartir.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('plantilla/img/img-compartir.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('plantilla/css/bootstrap_customized.min.css')}}" rel="stylesheet">
    <link href="{{asset('plantilla/css/style.css')}}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
	 <link href="{{asset('plantilla/css/listing.css')}}" rel="stylesheet">

	 {{-- slider css --}}
	 <link rel="stylesheet"  href="{{ asset('css/lightslider.css') }}"/>

    <!-- YOUR CUSTOM CSS -->
	<link href="{{asset('plantilla/css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

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

<header class="header_in clearfix is_sticky">
    <div id="logo">
    <a href="{{url('/')}}">
        <img src="{{asset('plantilla/img/logo.svg')}}" width="200" height="50" alt="">
    </a>
    </div>
    <div class="row justify-content-center text-center">
    <div class="col-xl-8 col-lg-10 col-md-8">
            <form id="form_principal" method="post" action="{{ route('directorio') }}" class="form-busqueda">
                <input name="_method" class="_method" type="hidden" value="get">
            <div class="row no-gutters custom-search-input">
                <div class="col-lg-6">
                <div class="form-group">
                    <input name="palabra_busqueda" class="form-control" type="text"  placeholder="Nombre del restaurante...">
                    <i class="icon_search"></i>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="form-group">
                        <input name="ciudad" class="form-control no_border_r"  type="text" placeholder="Ciudad">
                    <i class="icon_pin_alt"></i>
                </div>
                </div>
                <div class="col-lg-2">
                <input type="submit" value="Buscar">
                </div>

            </div>
            <!-- /row -->
        </form>
    </div>
        <nav class="main-menu">
            <div id="header_menu">

                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="{{ url('/') }}"><img src="{{asset('plantilla/img/logo.svg')}}" width="140" height="35" alt=""></a>
            </div>
            @guest

@else
@if(Auth::User()->profile === 1)
    <div class="dropdown show">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administrador
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('restaurant.index')}}">Ir al tablero</a>
            <a class="dropdown-item" href="{{ route('restaurant.create') }}">Registrar Restaurante</a>
            <a class="dropdown-item" href="{{route('restaurant.listado')}}">Listar Restaurantes</a>
            <a class="dropdown-item" href="{{route('users.index')}}">Listar Usuarios</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
    </div>
@endif

@endguest
</nav>
    </div>
</header>
	<!-- /header -->

    <!-- /Navigation-->


<div class="container-fluid p-4">
    <div class="container margin_login">
        <div class="row justify-content-center ">
            <div class="col-lg-5 bg-light p-5">
                <div class="sign_up ">
                    <div class="head">
                        <div class="title">
                        <h3>Políticas de privacidad</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <!--Aqui van las politicas-->

                </div>
                <!-- /box_booking -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
	</div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 footer">
                <div class="follow_us">
                    <ul>
                        <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('plantilla/img/facebook_icon.svg')}}" alt="" class="lazy"></a></li>
                        <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{asset('plantilla/img/instagram_icon.svg')}}" alt="" class="lazy"></a></li>
                    </ul>
                </div>
                <ul class="additional_links">
                    <li><a href="{{route('condiciones')}}">Términos y condiciones</a></li>
                    <li><a href="{{route('privacidad')}}">Políticas de privacidad</a></li>
                    <li><span>{{date('Y')}} © Food Zinder</span></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 >Contáctanos</h3>
                <div class="contacts" id="collapse_3">
                    <ul>
                        <li><i class="icon_house_alt"></i>La Cocotera Coworking<br>San Rosendo N° 12<br>Tarifa, Cádiz - España</li>
                        <li><i class="icon_mail_alt"></i><a href="#0">info@foodzinder.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3>Suscribirme al boletín</h3>
                <div class="" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Tu email">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
    </div>
</footer>

<!-- COMMON SCRIPTS -->
    <script src="{{asset('plantilla/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('plantilla/js/common_func.js')}}"></script>
    <script src="{{asset('plantilla/assets/validate.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{asset('plantilla/admin_section/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <script>
        $("#modalMensaje").modal('show');

        const check=document.querySelector("#defaultCheck2");
        const btnForm=document.querySelector(".btn-form");

        check.onclick=()=>{
            if(check.checked){
                btnForm.disabled=false;
            }else{
                btnForm.disabled=true;
            }
        }

    </script>
</body>

</html>
