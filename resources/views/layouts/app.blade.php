<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Food Zinder - Menús de restaurantes en imágenes">
		<meta name="author" content="Ansonika">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Food Zinder - Menús de restaurantes en imágenes</title>

		<!-- Favicons-->
		<link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
		<link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('plantilla/img/apple-touch-icon-57x57-precomposed.png') }}">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('plantilla/img/apple-touch-icon-72x72-precomposed.png')}}">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('plantilla/img/apple-touch-icon-114x114-precomposed.png')}}">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('plantilla/img/apple-touch-icon-144x144-precomposed.png')}}">

		<!-- GOOGLE WEB FONT -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

		<!-- BASE CSS -->
		<link href="{{asset('plantilla/css/bootstrap_customized.min.css')}}" rel="stylesheet">
		<link href="{{asset('plantilla/css/style.css')}}" rel="stylesheet">

		<!-- SPECIFIC CSS -->
		<link href="{{asset('plantilla/css/booking-sign_up.css')}}" rel="stylesheet">
		<link href="{{asset('plantilla/css/home.css')}}" rel="stylesheet">

		<!-- YOUR CUSTOM CSS -->
		<link href="{{asset('plantilla/css/custom.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

	</head>

	<body>

		<header class="header_in clearfix is_sticky">
			<div>
				<div id="logo">
					<a href="{{ url('/') }}">
						<img src="{{asset('plantilla/img/logo.svg')}}" width="200" height="50" alt="">
					</a>
				</div>
				<a href="#0" class="open_close">
					<i class="icon_menu"></i><span>Menu</span>
				</a>
				<nav class="main-menu">
					<div id="header_menu">
						<a href="#0" class="open_close">
							<i class="icon_close"></i><span>Menu</span>
						</a>
						<a href="{{ url('/') }}"><img src="{{asset('plantilla/img/logo.svg')}}" width="140" height="35" alt=""></a>
					</div>
					@guest
						<ul>
							<li><a href="{{ route('login') }}" class="ico-login">Iniciar Sesión / Registrarse</a></li>
						</ul>
					@else
						@if(Auth::User()->profile === 1)
							<div class="dropdown show user-link">
								<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Administrador
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{ route('restaurant.create') }}">Registrar Restaurante</a>
								<a class="dropdown-item" href="{{ route('directorio') }}">Listar Restaurantes</a>
								<a class="dropdown-item" href="{{ route('users.index') }}">Listar Usuarios</a>
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
						@else
							<div class="dropdown show user-link">
								<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{{ Auth::user()->name }}
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{ route('directorio') }}">Listar Restaurantes</a>
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

		<main class="bg_gray pattern add_top_menu">

			<div class="container home">
				<div class="row">
					<div class="col-md-6">
						<h1 class="titulo">Todos tus <span class="rosa">menús</span> de tus restaurantes <span class="rosa">en imágenes</span></h1>
						<div class="box_booking_2">
							<form method="post" action="{{ route('directorio') }}">
								<input name="_method" type="hidden" value="get">
								@csrf
								<div class="main">
									<div class="form-group">
										<input name="palabra_busqueda" class="form-control" placeholder="Tipo de cocina, nombre del restaurante...">
										<i class="icon_search"></i>
									</div>
									<div class="form-group">
										<input name="ciudad" class="form-control" placeholder="Ciudad">
										<i class="icon_pin_alt"></i>
									</div>
									<button type="submit" class="btn_1 full-width mb_5">Buscar</button>
								</div>
							</form>



						</div>
					</div>
			<!-- columna 2-->
					<div class="col-md-6">
						<div class="slider-home">
							<img src="{{asset('plantilla/img/platos/home-plato-01-min.png')}}" alt="" class="active img-fluid center">
							<img src="{{asset('plantilla/img/platos/home-plato-02-min.png')}}" alt="" class="img-fluid center">
							<img src="{{asset('plantilla/img/platos/home-plato-03-min.png')}}" alt="" class="img-fluid center">
						</div>
					</div>
				</div>

				<div class="container margin_60_40"></div>
			</div>
			<!-- /container -->
			<div class="call_section lazy" data-bg="url({{asset('plantilla/img/bg-duenos-cta-min.jpg')}})">
				<div class="container clearfix">
					<div class="col-lg-5 col-md-6 float-right wow">
							<div class="box_1">
								<h3>Registra tu restaurante</h3>
								<p>Te ayudaremos a crear tu <strong>menú</strong> en <strong>imágenes</strong></p>
								<a href="contacto.html" class="btn_1">Contáctanos</a>
							</div>
					</div>
				</div>
			</div>

		</main>
		<!-- /main -->

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
							<li><a href="#0">Términos y condiciones</a></li>
							<li><a href="#0">Políticas de privacidad</a></li>
							<li><span>{{ date('Y') }} © Food Zinder</span></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6">
						<h3>Contáctanos</h3>
						<div class="dont-collapse-sm contacts" id="collapse_3">
							<ul>
								<li><i class="icon_house_alt"></i>La Cocotera Coworking<br>San Rosendo N° 12<br>Tarifa, Cádiz - España</li>
								<li><i class="icon_mail_alt"></i><a href="#0">info@foodzinder.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
							<h3>Suscribirme al boletín</h3>
						<div class="dont-collapse-sm" id="collapse_4">
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
		<!--/footer-->

		<div id="toTop"></div><!-- Back to top button -->

		<div class="layer"></div><!-- Opacity Mask Menu Mobile -->

		<!-- COMMON SCRIPTS -->
		<script src="{{asset('plantilla/js/common_scripts.min.js')}}"></script>
		<script src="{{asset('plantilla/js/common_func.js')}}"></script>
		<script src="{{asset('plantilla/assets/validate.js')}}"></script>
		<script>
		function sliderhome() {
			$current = $('.slider-home img.active');
			if ($current.length == 0) {
			$('.slider-home img:first-child').addClass('active');
			} else {
			$next = $current.removeClass('active').next();
			if ($next.length == 0) {
				$('.slider-home img:first-child').addClass('active');
			} else {
				$next.addClass('active');
			}
			}
		}
		setInterval(sliderhome, 5000);</script>

	</body>
</html>
