<!DOCTYPE html>
<html lang="en">

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
					<ul>
						<li><a href="{{ route('login') }}" class="ico-login">Iniciar Sesión / Registrarse</a></li>
					</ul>
				</nav>
			</div>
		</header>
	<!-- /header -->

	<main class="bg_gray pattern">

		<div class="container margin_login">
		    <div class="row justify-content-center">
		        <div class="col-lg-4">
		        	<div class="sign_up">
		                <div class="head">
		                    <div class="title">
		                    <h3>Regístrate</h3>
		                </div>
		                </div>
                        <!-- /head -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="main">
                                <!-- <a href="#0" class="social_bt facebook">Regístrate con Facebook</a>
                                <a href="#0" class="social_bt google">Regístrate con Google</a>
                                <div class="divider"><span>O</span></div> -->
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre completo" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="icon_pencil"></i>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="icon_mail"></i>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="icon_lock"></i>
                                </div>
                                <div class="form-group add_bottom_15">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña" autocomplete="new-password">

                                    <i class="icon_lock"></i>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn_1 full-width mb_5">
                                    Registrarme
                                </button>
                                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión</a>
                                </div>
                            </div>
                        </form>
		            </div>
		            <!-- /box_booking -->
		        </div>
		        <!-- /col -->

		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->

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
						<div class="contacts" id="collapse_3">
							<ul>
								<li><i class="icon_house_alt"></i>La Cocotera Coworking<br>San Rosendo N° 12<br>Tarifa, Cádiz - España</li>
								<li><i class="icon_mail_alt"></i><a href="#0">info@foodzinder.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
							<h3>Suscribirme al boletín</h3>
						<div>
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
    <script src="{{asset('plantillajs/common_func.js')}}"></script>
    <script src="{{asset('plantilla/assets/validate.js')}}"></script>

</body>
</html>
