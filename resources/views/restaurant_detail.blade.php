<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Foogra - Discover & Book the best restaurants at the best price">
	<meta name="author" content="Ansonika">
	<title>{{$restaurant->nombre}} - Food Zinder</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />

	<!-- VUEJS -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

	<!-- Favicons-->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}" >
	<link rel="apple-touch-icon" type="image/x-icon" href="{{asset('plantilla/img/apple-touch-icon-57x57-precomposed.png')}}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('plantilla/img/apple-touch-icon-72x72-precomposed.png')}}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('plantilla/img/apple-touch-icon-114x114-precomposed.png')}}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('plantilla/img/apple-touch-icon-144x144-precomposed.png')}}">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- BASE CSS -->
	<link href="{{asset('plantilla/css/bootstrap_customized.min.css')}}" rel="stylesheet">
	<link href="{{asset('plantilla/css/style.css')}}" rel="stylesheet">


	<!-- YOUR CUSTOM CSS -->
	<link href="{{asset('plantilla/css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

	<!-- SPECIFIC CSS -->
	<link href="{{asset('plantilla/css/detail-page.css')}}" rel="stylesheet">
	<style>
		html {
			scroll-behavior: smooth;
		}

		.botonflotanteparaguardado {
			display:scroll;
			position:fixed;
			bottom:95px;
			right:35px;
			opacity: 1;
			cursor: pointer;
			z-index: 20;
			background-color: #F67599;
			color: #fff;
			border-radius: 25px;
		}
	</style>
</head>

<body>
	<div id="app">

    @if (session('mensaje'))
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
                El mensaje se ha enviado.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
        </div>

    @endif

	{{-- botón flotante --}}
	<button type="button" class="btn btn-default botonflotanteparaguardado" data-toggle="modal" data-target="#modalLista">Ver mi lista</button> {{-- end botón flotante --}}

	<!-- Modal-mi-lista -->
	<div class="modal fade" id="modalLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">MI LISTA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body modal-lista">
				<div class="container-fluid">
					<div v-for="item in carritoActual" class="row">
						<div class="col-2 d-none d-md-block">
							<img class="img-fluid" :src="item.imagen" alt="">
						</div>
						<div class="col-xs-12 col-sm">
							<h5>@{{ item.nombre }}</h5>
							<p class="text-muted">Precio unitario: @{{ item.precioUnitario }}</p>
						</div>
						<div class="col-sm-3 col-4 col-lg-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<button @click="restarCantidadItemDelCarrito(item.nombre)" class="input-group-text">-</button>
								</div>
								<input type="text" class="form-control text-center" :value="item.cantidad" aria-label="Username" aria-describedby="basic-addon1">
								<div class="input-group-append">
									<button @click="sumarCantidadItemDelCarrito(item.nombre)" class="input-group-text">+</button>
								 </div>
							 </div>
						</div>
						<div class="col col-sm-3">
							<p>Monto Total: @{{ item.precioCantidad }}</p>
						</div>
						<div class="col-1">
							<a href="#" @click.prevent="borrarItemDelCarrito(item.nombre)"><i class="fas fa-trash-alt"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		</div>
	</div><!-- end Modal-mi-lista -->




	<!-- Modal-new-item -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">

				</h5>
				<button id="botonCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="container-fluid">
					<div class="row">
						<div class="col text-center">
							<img class="img-fluid" :src="newItem.imagen" alt="Imagen responsive">
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<h5>@{{ newItem.nombre }}</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button @click="restarCantidad" class="input-group-text">-</button>
								</div>
								<input type="text" class="form-control text-center" :value="newItem.cantidad" aria-label="Username" aria-describedby="basic-addon1">
								<div class="input-group-append">
									<button @click="sumarCantidad" class="input-group-text">+</button>
								 </div>
							 </div>
						</div>
						<div class="col d-flex align-items-center justify-content-center">
							<h5>@{{ newItem.precioCantidad }} €</h5>
						</div>
					</div>
					<div class="row">
						<div class="col d-flex justify-content-center">
							<button @click="agregarAMiLista" type="button" class="btn btn-primary">Agregar a mi lista</button>
						</div>
					</div>
				</div>

			</div>
		</div>
		</div>
	</div>{{-- end Modal-new-item --}}

	<header class="header_in clearfix">
      <div id="logo">
         <a href="{{url('/')}}">
            <img src="{{asset('plantilla/img/logo.svg')}}" width="200" height="50" alt="">
         </a>
      </div>
      <div class="row justify-content-center text-center">
         <div class="col-xl-8 col-lg-10 col-md-8">
            <form id="form_principal" method="post" action="{{ route('directorio') }}" class="form-busqueda">
               <input name="_method" type="hidden" value="get">
               <div class="row no-gutters custom-search-input">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <input name="palabra_busqueda" class="form-control" type="text" placeholder="Tipo de cocina, nombre del restaurante...">
                        <i class="icon_search"></i>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="form-group">
                     <input name="ciudad" class="form-control no_border_r" type="text" placeholder="Ciudad">
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
               <ul>
                  <li><a href="{{ route('login') }}" class="ico-login">Iniciar Sesión / Registrarse</a></li>
               </ul>
            @else
               @if(Auth::User()->profile === 1)
                  <div class="dropdown show">
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
                  <div class="dropdown show">
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

	<main class="bg_gray pattern add_top_menu_90">

		<div class="hero_in detail_page background-image">
			<div class="wrapper opacity-mask img-fluid" data-opacity-mask="#00000078">
                <div id="carouselExampleControls" class="carousel slide h-100" data-ride="carousel">
                    <div class="carousel-inner h-100">
                        @foreach ($imagenes as $imagen)
                            @if($loop->index==0)
                                <div class="carousel-item active h-100 img-portada" style="background:url({{asset('public/'.$imagen)}});"></div>
                            @else
                                <div class="carousel-item h-100 img-portada" style="background:url({{asset('public/'.$imagen)}});"></div>
                            @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="main_info">
                        <div class="container full-width">
                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-6">
                                    <h1>{{$restaurant->nombre}}</h1>
                                    @if ($restaurant->google_maps)
                                        {{$restaurant->direccion}} - <a href="{{ $restaurant->google_maps }}" target="_blank">Ver en mapa</a>
                                    @else
                                        {{$restaurant->direccion}}
                                    @endif
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-6">
                                    <div class="buttons clearfix">
                                        <a id="boton_para_favorito" onclick="guardarEnLocalStorage(event)" data-restaurantid="{{ $restaurant->id }}" href="#" class="btn_hero wishlist"><i class="icon_heart"></i>Agregar a favoritos</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    </div>
                </div>
                <!-- /main_info -->
			</div>
		</div>
		<!--/hero_in-->

		<div class="container margin_detail full-width">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="tabs_detail">
		                <ul class="nav navigation nav-tabs sticky-tabs" id="mainNav" role="tablist">
								<li class="nav-item">
									<a id="tab-A" href="#cont1" class="navigation__link nav-link active">Entrantes</a>
								</li>
								<li class="nav-item">
									<a id="tab-B" href="#cont2" class="navigation__link nav-link">Sopas</a>
								</li>
								<li class="nav-item">
									<a id="tab-C" href="#cont3" class="navigation__link nav-link">Fritos</a>
								</li>
								<li class="nav-item">
									<a id="tab-D" href="#cont4" class="navigation__link nav-link">Carnes</a>
								</li>
								<li class="nav-item">
									<a id="tab-E" href="#cont5" class="navigation__link nav-link">Pescado</a>
								</li>
								<li class="nav-item">
									<a id="tab-F" href="#cont6" class="navigation__link nav-link">Pastas</a>
								</li>
								<li class="nav-item">
									<a id="tab-G" href="#cont7" class="navigation__link nav-link">Postres</a>
								</li>
								<li class="nav-item">
									<a id="tab-H" href="#cont8" class="navigation__link nav-link">Bebidas</a>
								</li>
		                </ul>

		                <div class="tab-content" role="tablist">
		                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
		                        <div role="tabpanel" aria-labelledby="heading-A">
		                            <div class="card-body info_content">
		                            	<div class="main_title page-section" id="cont1">
											<span><em></em></span>
											<h2>Entrantes</h2>
										</div>

											<div class="row">
												@if (count($entrantes) > 0)
													@foreach ($entrantes as $entrante)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('entrantes', '{{ $entrante->id }}', '{{ asset('public/'.$entrante->imagen) }}', '{{ $entrante->nombre }}', '{{ $entrante->precio }}' )" href="#" class="strip_info" data-toggle="modal" data-target="#exampleModalCenter">
																		<img  src="{{ asset('public/'.$entrante->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $entrante->nombre }}</h3>
																			<span>{{ $entrante->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont2">
												<span><em></em></span>
												<h2>Sopas</h2>
											</div>

											<div class="row">
												@if ($sopas)
													@foreach ($sopas as $sopa)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('sopa', '{{ $sopa->id }}', '{{ url($sopa->imagen) }}', '{{ $sopa->nombre }}', '{{ $sopa->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($sopa->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $sopa->nombre }}</h3>
																			<span>{{ $sopa->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont3">
												<span><em></em></span>
												<h2>Fritos</h2>
											</div>

											<div class="row">
												@if ($fritos)
													@foreach ($fritos as $frito)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('frito', '{{ $frito->id }}', '{{ url($frito->imagen) }}', '{{ $frito->nombre }}', '{{ $frito->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($frito->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $frito->nombre }}</h3>
																			<span>{{ $frito->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont4">
												<span><em></em></span>
												<h2>Carnes</h2>
											</div>

											<div class="row">
												@if ($carnes)
													@foreach ($carnes as $carne)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('carne', '{{ $carne->id }}', '{{ url($carne->imagen) }}', '{{ $carne->nombre }}', '{{ $carne->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($carne->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $carne->nombre }}</h3>
																			<span>{{ $carne->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont5">
												<span><em></em></span>
												<h2>Pescado</h2>
											</div>

											<div class="row">
												@if ($pescados)
													@foreach ($pescados as $pescado)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('pescado', '{{ $pescado->id }}', '{{ url($pescado->imagen) }}', '{{ $pescado->nombre }}', '{{ $pescado->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($pescado->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $pescado->nombre }}</h3>
																			<span>{{ $pescado->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont6">
												<span><em></em></span>
												<h2>Pastas</h2>
											</div>

											<div class="row">
												@if ($pastas)
													@foreach ($pastas as $pasta)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('pasta', '{{ $pasta->id }}', '{{ url($pasta->imagen) }}', '{{ $pasta->nombre }}', '{{ $pasta->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($pasta->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $pasta->nombre }}</h3>
																			<span>{{ $pasta->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont7">
												<span><em></em></span>
												<h2>Postres</h2>
											</div>

											<div class="row">
												@if ($postres)
													@foreach ($postres as $postre)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('postre', '{{ $postre->id }}', '{{ url($postre->imagen) }}', '{{ $postre->nombre }}', '{{ $postre->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($postre->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $postre->nombre }}</h3>
																			<span>{{ $postre->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}

											<div class="main_title page-section add_top_30" id="cont8">
												<span><em></em></span>
												<h2>Bebidas</h2>
											</div>


											<div class="row">
												@if ($bebidas)
													@foreach ($bebidas as $bebida)
														<div class="col-md-4">
															<div class="item">
																<div class="strip">
																	<a @click="itemClicado('bebida', '{{ $bebida->id }}', '{{ url($bebida->imagen) }}', '{{ $bebida->nombre }}', '{{ $bebida->precio }}' )" href="#" class="strip_info"  data-toggle="modal" data-target="#exampleModalCenter">
																		<img src="{{ url($bebida->imagen) }}" class="owl-lazy plate-100" alt="">
																		<div class="item_title_ind">
																			<h3>{{ $bebida->nombre }}</h3>
																			<span>{{ $bebida->precio }} €</span>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>{{-- end row --}}


										</div>
									</div>
								</div>
		                    <!-- /tab -->


		                </div>
		                <!-- /tab-content -->
		            </div>
		            <!-- /tabs_detail -->
		        </div>
		        <!-- /col -->



		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->

        <section class="contacto__cont-contacto section">
		<div class="cont">
			<h2 class="activo" id="contactoE">
				Envía un mensaje a este restaurante
			</h2>
			<div class="contacto__cont-formulario">
				<form class="form" method="post" action="{{ route('directorio.enviarCorreo') }}">
                 @csrf
					<div class="mensaje">
						<h3></h3>
					</div>
					<input required class="validar" type="text"  id="nombre"  name="name" minLength="2"  maxLength="30"  placeholder="Ingrese su nombre"/>
					<input required class="validar" type="email" id="email" name="email" placeholder="Ingrese su correo electrónico"/>
					<textarea class="textarea" required name="mensaje" class="validar" placeholder="Escriba un mensaje"  minLength="20"  maxLength="500"></textarea>
					<input type="hidden" name="id" value="{{$restaurant->id}}"/>
                    <input type="hidden" name="correoRestaurante" value="{{$restaurant->correo}}"/>
					<button class="btn-contacto" type="submit">Enviar</button>
				</form>

				<img src="{{asset('plantilla/img/reyeno.svg')}}" class="img-form" />
			</div>

		</div>
	</section>
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
						<li><span>{{date('Y')}} © Food Zinder</span></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 >Contáctanos</h3>
					<div class=" contacts" id="collapse_3">
						<ul>
							<li><i class="icon_house_alt"></i>La Cocotera Coworking<br>San Rosendo N° 12<br>Tarifa, Cádiz - España</li>
							<li><i class="icon_mail_alt"></i><a href="#0">info@foodzinder.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 >Suscribirme al boletín</h3>
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
	<!--/footer-->

	<div id="toTop"></div><!-- Back to top button -->

	<div class="layer"></div><!-- Opacity Mask Menu Mobile -->

	<!-- Sign In Modal -->
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Sign In</h3>
		</div>
		<form >
			<div class="sign-in-wrapper">
				<a href="#0" class="social_bt facebook">Login with Facebook</a>
				<a href="#0" class="social_bt google">Login with Google</a>
				<div class="divider"><span>Or</span></div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" id="email">
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" id="password" value="">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="clearfix add_bottom_15">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
				</div>
				<div class="text-center">
					<input type="submit" value="Log In" class="btn_1 full-width mb_5">
					Don’t have an account? <a href="account.html">Sign up</a>
				</div>
				<div id="forgot_pw">
					<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email_forgot" id="email_forgot">
						<i class="icon_mail_alt"></i>
					</div>
					<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
				</div>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Sign In Modal -->

</div> {{-- end vuejs --}}

<script src="{{asset('js/enviarCorreo.js')}}"></script>

	<!-- COMMON SCRIPTS -->
    <script src="{{asset('plantilla/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('plantilla/js/common_func.js')}}"></script>
    <script src="{{asset('plantilla/assets/validate.js')}}"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="{{asset('plantilla/js/sticky_sidebar.min.js')}}"></script>
    <script src="{{asset('plantilla/js/specific_detail.js')}}"></script>
	<script src="{{asset('plantilla/js/datepicker.min.js')}}"></script>
	<script src="{{asset('plantilla/js/datepicker_func_1.js')}}"></script>

	<script>
		let boton_favorito = document.querySelector('#boton_para_favorito');
		let restaurantId = boton_favorito.dataset.restaurantid;

		// buscamos el item en local storage:
		let FAVORITO = localStorage.getItem(`restaurantid${restaurantId}`);
		if (!FAVORITO) {
			// no existe en local storage
			localStorage.setItem(`restaurantid${restaurantId}`, 'unliked');
		} else {
			revisarLocalStorage();
		}

		function guardarEnLocalStorage(event){
			event.preventDefault();
			if (document.querySelector('#boton_para_favorito').classList.contains('liked')) {
				localStorage.setItem(`restaurantid${restaurantId}`, 'unliked');
				document.querySelector('#boton_para_favorito').classList.remove('liked');
			} else {
				localStorage.setItem(`restaurantid${restaurantId}`, 'liked');
				document.querySelector('#boton_para_favorito').classList.add('liked');
			}
		}

		function revisarLocalStorage(){
			if (FAVORITO == 'liked') {
				boton_favorito.classList.add('liked');
			} else {
				boton_favorito.classList.remove('liked');
			}
		}

	</script>

	{{-- STARTS VUEJS --}}
	<script>

		const restauranteID = "{{ $restaurant->id }}";

		const app = new Vue({
			el: "#app",
			data: {
				carritoActual: [],
				mostrarCarrito: false,
				newItem: {
					categoria: "",
					id: "",
					imagen: "",
					nombre: "",
					precioUnitario: 0,
					cantidad: 1,
					precioCantidad: 0
				}
			},
			methods: {
				itemClicado: function (categoria, id, imagen, nombre, precio){
					this.newItem = {
						categoria: categoria,
						id: id,
						imagen: imagen,
						nombre: nombre,
						precioUnitario: precio,
						cantidad: 1,
						precioCantidad: precio
					}
				},

				restarCantidad: function (){
					if (this.newItem.cantidad >= 2) {
						this.newItem.cantidad--;
						this.newItem.precioCantidad = this.newItem.precioUnitario * this.newItem.cantidad;
					}
				},

				sumarCantidad: function (){
					this.newItem.cantidad++;
					this.newItem.precioCantidad = this.newItem.precioUnitario * this.newItem.cantidad;
				},

				agregarAMiLista: function (){
					if (this.carritoActual.length === 0) {
						this.carritoActual.push(this.newItem);
					} else {
						for (let i = 0; i < this.carritoActual.length; i++) {
							const elementoEnElcarrito = this.carritoActual[i];
							if (elementoEnElcarrito.id === this.newItem.id) {
								this.carritoActual[i].cantidad += this.newItem.cantidad;
								this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
							}
						}
						this.carritoActual.push(this.newItem);
					}
					document.querySelector('#botonCerrarModal').click();
					this.newItem = {
						categoria: "",
						id: "",
						imagen: "",
						nombre: "",
						precioUnitario: 0,
						cantidad: 1,
						precioCantidad: 0
					};
				},

				borrarItemDelCarrito: function (nombre){
					this.carritoActual = this.carritoActual.filter(item => item.nombre !== nombre);
				},

				restarCantidadItemDelCarrito: function(nombre){
					for (let i = 0; i < this.carritoActual.length; i++) {
						const elemento = this.carritoActual[i];
						if (elemento.nombre === nombre && elemento.cantidad >= 2) {
							//restar cantidad
							this.carritoActual[i].cantidad--;
							//restar monto total
							this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
						}
					}
				},

				sumarCantidadItemDelCarrito: function (nombre){
					for (let i = 0; i < this.carritoActual.length; i++) {
						const elemento = this.carritoActual[i];
						if (elemento.nombre === nombre) {
							//restar cantidad
							this.carritoActual[i].cantidad++;
							//restar monto total
							this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
						}
					}
				}
			},
			mounted(){
				// buscamos el item en local storage:
				let carritoEnLocalStorage = localStorage.getItem(`carrito-resto-${restauranteID}`);
				if (!carritoEnLocalStorage) {
					// no existe en local storage
					localStorage.setItem(`carrito-resto-${restaurantId}`, JSON.stringify( this.carritoActual ));
				} else {
					this.carritoActual = JSON.parse( carritoEnLocalStorage );
				}
			},
			watch: {
				carritoActual: function(){
					localStorage.setItem(`carrito-resto-${restaurantId}`, JSON.stringify( this.carritoActual ));
				}
			}
		})
	</script>

        <!-- Scroll Spy -->
    <script>
        $(window).scroll(function() {
            var scrollDistance = $(window).scrollTop() - $(window).height();

            // Assign active class to nav links while scolling
            $('.page-section').each(function(i) {
                if ($(this).position().top <= scrollDistance) {
                    document.querySelector("#mainNav").scrollLeft=document.querySelectorAll(".navigation>li")[i].offsetLeft-30;
                    $('.navigation a.active').removeClass('active');
                    $('.navigation a').eq(i).addClass('active');
                }
            });
        }).scroll();
    </script>

    <script>
        $("#modalMensaje").modal('show');
    </script>
</body>
</html>


