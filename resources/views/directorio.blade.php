<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Foogra - Discover & Book the best restaurantes at the best price">
	 <meta name="author" content="Ansonika">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
	 <title>Lista de restaurantes en imágenes - Food Zinder</title>

	 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

<body>
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
                           <input name="palabra_busqueda" class="form-control" type="text" value="{{ ($request->palabra_busqueda != null) ? $request->palabra_busqueda : "" }}" placeholder="Nombre del restaurante...">
                           <i class="icon_search"></i>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
								<input name="ciudad" class="form-control no_border_r" value="{{ ($request->ciudad != null) ? $request->ciudad : "" }}" type="text" placeholder="Ciudad">
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

	<main class="bg_gray pattern add_top_menu">

		<!-- /page_header -->
        <div class="container margin_30_40">
			<div class="row">
                <form class="filtroAjax">
				<aside class="col-lg-3" id="sidebar">
					<div class="filter_col">
                        <div class="inner_bt">
                            <span class="borrar-filtros" onclick="borrrarFiltros()">
                                <i class="fas fa-trash-alt"></i>
                                Borrar filtros
                            </span>
                            <a href="#" class="open_filters"><i class="icon_close"></i></a></div>
                        <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_1" data-toggle="collapse" class="opened">Distancia</a></h4>
							<div class="collapse show" id="filter_1">
                        <div class="distance"> Radio alrededor del área seleccionada</div>
                        <div class="add_bottom_15"><input type="range" min="1" max="50" step="1" value="5" data-orientation="horizontal"></div>
                        <div class="distance"><span></span> km</div>
							</div>
								</div>
                        <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_2" data-toggle="collapse" class="opened">Precio</a></h4>
							<div class="collapse show" id="filter_2">

									<li>
										<label class="container_check">€ - Baratos<small>{{ count($cantidades['precio1']) }}</small>
											<input {{ $request->precio1 != null ? 'checked': '' }} name="precio1" class="inputs" onchange="consultar()" type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">€€ - Gama media<small>{{ count($cantidades['precio2']) }}</small>
											<input {{ $request->precio2 != null ? 'checked': '' }} name="precio2" class="inputs" onchange="consultar()" name="precio2" class="inputs" onchange="consultar()" type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">€€€ - Elegante<small>{{ count($cantidades['precio3']) }}</small>
											<input {{ $request->precio3 != null ? 'checked': '' }} name="precio3" class="inputs" onchange="consultar()" name="precio3" class="inputs" onchange="consultar()" type="checkbox">
											<span class="checkmark"></span>
										</label>
									</li>
								</ul>
							</div>
                        </div>
                        <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_3" data-toggle="collapse" class="opened">Tipo de establecimiento</a></h4>
							<div class="collapse show" id="filter_3">
								<ul>
										<li>
											<label class="container_check">Restaurante<small>{{ count($cantidades['restaurante']) }}</small>
											  <input {{ $request->restaurante != null ? 'checked': '' }} name="restaurante" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Cafetería<small>{{ count($cantidades['cafeteria']) }}</small>
											  <input {{ $request->cafeteria != null ? 'checked': '' }} name="cafeteria" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Bar<small>{{ count($cantidades['bar']) }}</small>
											  <input {{ $request->bar != null ? 'checked': '' }} name="bar" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
									</ul>
							</div>
                        </div>
                        <!-- /filter_type -->
						<div class="filter_type caracteristicas">
							<h4><a href="#filter_4" data-toggle="collapse" class="opened">Características</a></h4>
							<div class="collapse show" id="filter_4">
								<ul>
										<li>
											<label class="container_check">Admite reservas <img src="{{ asset('plantilla/img/filtros_img/admite-reservas.png') }}"><small>{{ count($cantidades['admite_reservas']) }}</small>
											  <input {{ $request->admite_reservas != null ? 'checked': '' }} name="admite_reservas" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Para llevar <img src="{{ asset('plantilla/img/filtros_img/para-llevar.png') }}"><small>{{ count($cantidades['para_llevar']) }}</small>
											  <input {{ $request->para_llevar != null ? 'checked': '' }} name="para_llevar" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">A domicilio <img src="{{ asset('plantilla/img/filtros_img/a-domicilio.png') }}"><small>{{ count($cantidades['domicilio']) }}</small>
											  <input {{ $request->domicilio != null ? 'checked': '' }} name="domicilio" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
                                        </li>
                                        <li>
											<label class="container_check">Terraza Exterior <img src="{{ asset('plantilla/img/filtros_img/terraza-exterior.png') }}"><small>{{ count($cantidades['terraza_exterior']) }}</small>
											  <input {{ $request->terraza_exterior != null ? 'checked': '' }} name="terraza_exterior" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
                                        </li>
                                        <li>
											<label class="container_check">Wifi gratuito <img src="{{ asset('plantilla/img/filtros_img/wifi-gratis.png') }}"><small>{{ count($cantidades['wifi_gratuito']) }}</small>
											  <input {{ $request->wifi_gratuito != null ? 'checked': '' }} name="wifi_gratuito" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
                                        </li>
                                        <li>
											<label class="container_check">Sin gluten <img src="{{ asset('plantilla/img/filtros_img/gluten-free.png') }}"><small>{{ count($cantidades['sin_gluten']) }}</small>
											  <input {{ $request->sin_gluten != null ? 'checked': '' }} name="sin_gluten" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Accesible <img src="{{ asset('plantilla/img/filtros_img/accesible.png') }}"><small>{{ count($cantidades['accesible']) }}</small>
											  <input {{ $request->accesible != null ? 'checked': '' }} name="accesible" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Admite mascotas <img src="{{ asset('plantilla/img/filtros_img/admite-mascotas.png') }}"><small>{{ count($cantidades['admite_mascotas']) }}</small>
											  <input {{ $request->admite_mascotas != null ? 'checked': '' }} name="admite_mascotas" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Plastic Free <img src="{{ asset('plantilla/img/filtros_img/plastic-free.png') }}"><small>{{ count($cantidades['plastic_free']) }}</small>
											  <input {{ $request->plastic_free != null ? 'checked': '' }} name="plastic_free" class="inputs" onchange="consultar()" type="checkbox">
											  <span class="checkmark"></span>
											</label>
                              </li>
									</ul>
							</div>
                  </div>
                  <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_5" data-toggle="collapse" class="opened">Comidas</a></h4>
							<div class="collapse show" id="filter_5">
								<ul>
                           <li>
                              <label class="container_check">Desayuno<small>{{ count($cantidades['desayuno']) }}</small>
                                 <input {{ $request->desayuno != null ? 'checked': '' }} name="desayuno" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Brunch<small>{{ count($cantidades['brunch']) }}</small>
                                 <input {{ $request->brunch != null ? 'checked': '' }} name="brunch" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Almuerzo<small>{{ count($cantidades['almuerzo']) }}</small>
                                 <input {{ $request->almuerzo != null ? 'checked': '' }} name="almuerzo" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Merienda<small>{{ count($cantidades['merienda']) }}</small>
                                 <input {{ $request->merienda != null ? 'checked': '' }} name="merienda" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Cena<small>{{ count($cantidades['cena']) }}</small>
                                 <input {{ $request->cena != null ? 'checked': '' }} name="cena" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                        </ul>
							</div>
                  </div>
                  <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_6" data-toggle="collapse" class="opened">Soy más de</a></h4>
							<div class="collapse show" id="filter_6">
								<ul>
                           <li>
                              <label class="container_check">Dulce<small>{{ count($cantidades['dulce']) }}</small>
                                 <input {{ $request->dulce != null ? 'checked': '' }} name="dulce" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Salado<small>{{ count($cantidades['salado']) }}</small>
                                 <input {{ $request->salado != null ? 'checked': '' }} name="salado" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                        </ul>
							</div>
                  </div>
                  <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_7" data-toggle="collapse" class="opened">Tipo de Cocina</a></h4>
							<div class="collapse show" id="filter_7">
								<ul>
                           <li>
                              <label class="container_check">Local<small>{{ count($cantidades['local']) }}</small>
                                 <input {{ $request->local != null ? 'checked': '' }} name="local" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Nacional<small>{{ count($cantidades['nacional']) }}</small>
                                 <input {{ $request->nacional != null ? 'checked': '' }} name="nacional" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Internacional<small>{{ count($cantidades['internacional']) }}</small>
                                 <input {{ $request->internacional != null ? 'checked': '' }} name="internacional" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Fusión<small>{{ count($cantidades['fusion']) }}</small>
                                 <input {{ $request->fusion != null ? 'checked': '' }} name="fusion" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                        </ul>
							</div>
                  </div>
                  <!-- /filter_type -->
						<div class="filter_type">
							<h4><a href="#filter_8" data-toggle="collapse" class="opened">Platos</a></h4>
							<div class="collapse show" id="filter_8">
								<ul>
                           <li>
                              <label class="container_check">Vegetariano<small class="verde">{{ count($cantidades['vegetariano']) }}</small>
                                 <input {{ $request->vegetariano != null ? 'checked': '' }} name="vegetariano" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Vegano<small class="verde">{{ count($cantidades['vegano']) }}</small>
                                 <input {{ $request->vegano != null ? 'checked': '' }} name="vegano" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Marisco<small class="azul">{{ count($cantidades['marisco']) }}</small>
                                 <input {{ $request->marisco != null ? 'checked': '' }} name="marisco" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Atún<small class="azul">{{ count($cantidades['atun']) }}</small>
                                 <input {{ $request->atun != null ? 'checked': '' }} name="atun" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Sushi<small class="azul">{{ count($cantidades['sushi']) }}</small>
                                 <input {{ $request->sushi != null ? 'checked': '' }} name="sushi" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
									</li>
                           <li>
                              <label class="container_check">Pescado<small class="azul">{{ count($cantidades['pescado']) }}</small>
                                 <input {{ $request->pescado != null ? 'checked': '' }} name="pescado" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Carne<small class="rojo">{{ count($cantidades['carne']) }}</small>
                                 <input {{ $request->carne != null ? 'checked': '' }} name="carne" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Paella<small class="rojo">{{ count($cantidades['paella']) }}</small>
                                 <input {{ $request->paella != null ? 'checked': '' }} name="paella" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Pasta<small class="morado">{{ count($cantidades['pasta']) }}</small>
                                 <input {{ $request->pasta != null ? 'checked': '' }} name="pasta" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Pizza<small class="morado">{{ count($cantidades['pizza']) }}</small>
                                 <input {{ $request->pizza != null ? 'checked': '' }} name="pizza" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                           <li>
                              <label class="container_check">Zumos y Batidos<small class="vinotinto">{{ count($cantidades['zumos_y_batidos']) }}</small>
                                 <input {{ $request->zumos_y_batidos != null ? 'checked': '' }} name="zumos_y_batidos" class="inputs" onchange="consultar()" type="checkbox">
                                 <span class="checkmark"></span>
                              </label>
                           </li>
                        </ul>
                     </div>

                  </div>
                  <!-- /filter_type -->
                    <div class="btn-ver-filtros d-lg-none" onclick="consultar(true)">
                         Ver <span class="numResul"></span> resultados

                     </div>
					</div>


				</aside>
                </form>
                <?php
                    $filtros=$request->all();

                    unset($filtros["_method"]);
                    unset($filtros["palabra_busqueda"]);

                    $numFiltros=sizeof($filtros);
                ?>
				<div class="col-lg-9">
					<div class="row align-items-center justify-content-between p-2">
						<h2 class="title-directorio m-0">
                            {{count($restaurantes_sin_paginar)}} resultados
                            <p style="font-size:16px;color:gray;">{{$numFiltros}} filtros aplicados</p>
                        </h2>

						<a href="#0" class="open_filters btn_filters">Ver Filtros</a>
					</div>
					@foreach ($restaurantes as $restaurant)
						<div class="row resultados">

							{{-- START - SLIDER --}}
							<div class="col-md-8 p-0" style="overflow:hidden;">

							 <div class="content-slider ul-slider">
                                 <div class="cont-flechas">
                                     <span>
                                         <div class="arrow arrow--left"></div>
                                     </span>
                                     <span>
                                        <div class="arrow arrow--right"></div>
                                     </span>
                                 </div>
                                 <ul>
                                     @foreach ($restaurant->platos->slice(0, 4) as $plato)

                                        @if($loop->index == 3)
                                            <div
                                                class="li-slider"
                                                style=" background-image:url({{asset('public'.$plato->imagen)}});"
                                            >
                                            <a href="{{ route('directorio.detail', ['id' => $restaurant->id]) }}" class="ver-menu">VER MENÚ COMPLETO</a>
                                            </div>
                                        @else
                                            <div
                                                class="li-slider"
                                                style=" background-image:url({{asset('public'.$plato->imagen)}});"
                                            >
                                        </div>
                                        @endif
                                     @endforeach

                                 </ul>

							 </div>

							</div>
							{{-- END - SLIDER --}}

							<div class="col-md-4 info">
								<h2>
									{{ $restaurant->nombre }}
								</h2>
								<p class="icon ubicacion">
									{{ $restaurant->direccion }} - {{ $restaurant->ciudad }}
									@if ($restaurant->google_maps)
										<a href="{{ $restaurant->google_maps }}" target="_blank">VER MAPA</a>
									@endif
								</p>
								<p class="icon telefono d-flex align-items-center">
									<span href="#"> {{ $restaurant->telefono }}</span>
									@if ($restaurant->tiene_whatsapp === 1)
										<a target="_blank" title="Ir a Whatsapp" href="https://api.whatsapp.com/send?phone=34{{ $restaurant->telefono }}" class="ml-4">
											<img class="img-fluid" style="max-width: 20px;" src="{{ asset('plantilla/img/whatsapp.png') }}" alt="Logo de Whatsapp">
										</a>
									@endif
								</p>
								<p>
									{{ $restaurant->horario }}
								</p>
								<p>
								<a class="btn_1" href="{{ route('directorio.detail', ['id' => $restaurant->id]) }}">Ver menú completo »</a>
								</p>
							</div>
						</div>
					@endforeach

					{{-- PAGINACIÓN --}}
					{{$restaurantes->links()}}


					{{-- <!-- /row -->
					<div class="pagination_fg">
						<a href="{{ $restaurantes->links()->elements[0][1] }}">&laquo;</a>
						@foreach ($restaurantes->links()->elements[0] as $posicion => $elemento)
							<a href="{{ $elemento }}" class="{{ ($restaurantes->links()->paginator->currentPage() == $posicion) ? 'active' : '' }}">{{ $posicion }}</a>
						@endforeach
						<a href="{{ $restaurantes->links()->elements[0][ count($restaurantes->links()->elements[0]) ] }}">&raquo;</a>
					</div> --}}
				</div>
				<!-- /col -->
			</div>
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
	<!--/footer-->

	<div id="toTop"></div><!-- Back to top button -->

	<div class="layer"></div><!-- Opacity Mask Menu Mobile -->




		<!-- COMMON SCRIPTS -->
    {{-- <script src="{{asset('plantilla/js/common_scripts.min.js')}}"></script> --}}
    {{-- <script src="{{asset('plantilla/js/common_func.js')}}"></script> --}}
    <script src="{{asset('plantilla/assets/validate.js')}}"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="{{asset('plantilla/js/sticky_sidebar.min.js')}}"></script>
	 <script src="{{asset('plantilla/js/specific_listing.js')}}"></script>

	 <script src="{{ asset('js/lightslider.js') }}"></script>

	<script>
        let formulario = $('#form_principal');
		let all_inputs = $('.inputs');

        function borrrarFiltros(){
            for (let i = 0; i < all_inputs.length; i++) {
                all_inputs[i].checked=false;
            }
            consultar();
        }

		function consultar(enviar=false)
		{

            if(window.innerWidth<990 && enviar ==false){
                document.querySelector("._method").value="post";

                const resp=fetch("directorio/obtenerResultadosFiltros",{
                    headers:{
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    method:'POST',
                    body: new FormData(document.querySelector(".filtroAjax"))
                }).then(function(response) {
                    if(response.ok) {
                        return response.text();
                    } else {
                        throw "Error en la llamada Ajax";
                    }
                })
                .then(function(texto) {
                    document.querySelector(".numResul").innerHTML=texto;
                })
                .catch(function(err) {
                    console.log(err);
                });
            }else{
                for (let i = 0; i < all_inputs.length; i++) {
				    var input = all_inputs[i];
                    input.style.display="none";
				    formulario.append(input);
			    }
                document.querySelector("._method").value="get";
                formulario.submit();
            }
		}

		function broadcast(informacion_a_transmitir, url) {
			$.ajax({
				url: url,
				type: "POST",
				data: informacion_a_transmitir,
				headers: {
						'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr("content")
				}
			})
		}


	</script>


</body>
</html>
