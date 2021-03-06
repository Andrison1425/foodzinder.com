<!DOCTYPE html>
<html lang="es">
<?php
    $nombreAlergenos=[
        'Gluten','Crustáceos','Huevos','Pescado',
        'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
        'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
        'Moluscos','Altramuces'
    ];
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=2">
	<meta name="description" content="Todos los menús de tus restaurantes en imágenes">
	<meta name="author" content="Ansonika">
	<title>{{$restaurant->nombre}} - Food Zinder</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
	<!-- VUEJS -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

	<!-- Favicons-->
	<link rel="shortcut icon" type="image/x-icon" href="@if($restaurant->imgMin==1){{asset('plantilla/img/img-compartir.png')}}@else{{asset('public/'.$restaurant->imgMin)}}@endif" >
    <link rel="apple-touch-icon" type="image/x-icon" href="@if($restaurant->imgMin==1){{asset('plantilla/img/img-compartir.png')}}@else{{asset('public/'.$restaurant->imgMin)}}@endif">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="@if($restaurant->imgMin==1){{asset('plantilla/img/img-compartir.png')}}@else{{asset('public/'.$restaurant->imgMin)}}@endif">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="@if($restaurant->imgMin==1){{asset('plantilla/img/img-compartir.png')}}@else{{asset('public/'.$restaurant->imgMin)}}@endif">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="@if($restaurant->imgMin==1){{asset('plantilla/img/img-compartir.png')}}@else{{asset('public/'.$restaurant->imgMin)}}@endif">
	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


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
			bottom: 20px;
            right: 20px;
			opacity: 1;
			cursor: pointer;
			z-index: 1000;
			background-color: #F67599;
			color: #fff;
			border-radius: 25px;
		}
        .btn-agregar {
		
			bottom: 20px;
            right: 20px;
			opacity: 1;
			cursor: pointer;
		
			background-color: #F67599;
			color: #fff;
			border-radius: 25px;
		}

        .tooltip-a{
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin:0 0 0.5rem 0.4rem;
        }

        .tooltip-a span{
            display: none;
            transition: all 0.5s ease;
        }

        .tooltip-a span::after{
            margin-top: 9px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #2B222A;
            content: " ";
            font-size: 0;
            line-height: 0;
            margin-left: -5px;
            width: 0;
        }

        .tooltip-a:hover span{
            position: absolute;
            display: flex;
            top: -44px;
            background-color: #2B222A;
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            text-transform: none;
            width: max-content;
            text-align: center;
            flex-direction: column;
            align-items: center;
            height: 40px;
        }

	</style>
</head>

<body>
	<div id="app">
        <span id="top"></span>
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
							<h5>@{{ item.nombre }} -  @{{ item.nombrePresentacion }}</h5>
							<p class="text-muted">Precio unitario: @{{ item.precioUnitario }} €</p>
						</div>
						<div class="col-sm-3 col-4 col-lg-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<button @click="restarCantidadItemDelCarrito(item.nombre, item.presentacion)" class="input-group-text">-</button>
								</div>
								<input type="text" class="form-control text-center" :value="item.cantidad" aria-label="Username" aria-describedby="basic-addon1">
								<div class="input-group-append">
									<button @click="sumarCantidadItemDelCarrito(item.nombre, item.presentacion)" class="input-group-text">+</button>
								 </div>
							 </div>
						</div>
						<div class="col col-sm-3">
							<p>Precio Total: @{{ item.precioCantidad }} €</p>
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
                    <div class="row mt-2">
                        <p>
                            @{{ newItem.descripcion }}
                        </p>
                    </div>

                    <div class="row mt-2">
                        <span v-for="alergeno in newItem.alergenos" class="tooltip-a">
                            <span>@{{newItem.nombreAlergenos[alergeno-1]}}</span>
                            <img :src=`{{asset('public/images/alergenos')}}${'/'+alergeno}.png` class="img-alergeno" alt="">
                        </span>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
                
               <!--  <div class="row w-100" v-if="flag === 1">
                        <div class="col d-flex align-items-center justify-content-center">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <button @click="restarCantidad" class="input-group-text">-</button>
                                </div>
                                <input type="text" class="form-control text-center " aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button @click="sumarCantidad" class="input-group-text">+</button>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="col d-flex align-items-center justify-content-center">
                            <h5>@{{newItem.precioUnitario}} €</h5>
                        </div>
                    </div>-->
                
			    <div  class="row w-100" v-for="presentacion in newItem.presentacion">
			         <div class="col d-flex align-items-center justify-content-center">
                            <h5>@{{ presentacion.nombre }}</h5>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <button @click="restarCantidad(presentacion.index)" class="input-group-text">-</button>
                                </div>
                                <input type="text" class="form-control text-center " :value="presentacion.cantidad" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button @click="sumarCantidad(presentacion.index)" class="input-group-text">+</button>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="col d-flex align-items-center justify-content-center">
                            <h5>@{{ presentacion.precioCantidad }} €</h5>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <button @click="agregarAMiLista(presentacion.index)" type="button" class="btn btn-agregar">Agregar</button>
                            </div>
                        </div>
                    </div>
                

                
                
			</div>
		</div>
		</div>
	</div>{{-- end Modal-new-item --}}

	<header class="header_in d-flex align-items-center justify-content-between">
        <button class="btn btn_contactar ml-2 ">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
        <h2 class="m-0 ml-2 headerTitle" style="color:#f67599;">
            {{$restaurant->nombre}}
        </h2>
        <a href="{{ url('/') }}"><img src="{{asset('plantilla/img/logo.svg')}}" width="140" height="35" alt=""></a>
   </header>
<!-- /header -->

	<main class="bg_gray pattern add_top_menu_90">

		<div class="hero_in detail_page background-image">
			<div class="wrapper opacity-mask img-fluid" data-opacity-mask="#00000078">
                <div id="carouselExampleControls" class="carousel slide h-100" style="background-color:black;" data-ride="carousel">
                    <div class="carousel-inner h-100" style="opacity:0.6;">
                        @foreach ($imagenes as $imagen)
                            @if($loop->index==0)
                                <div class="carousel-item active h-100 img-portada" style="background:url({{asset('public/'.$imagen)}});" data-toggle="modal" data-target=".bd-example-modal-lg"></div>
                            @else
                                <div class="carousel-item h-100 img-portada" data-img="{{asset('public/'.$imagen)}}" data-toggle="modal" data-target=".bd-example-modal-lg"></div>
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
                                <div class="col-12 mb-3 txtDireccion d-flex" >
                                    @if ($restaurant->google_maps)
                                        <span>{{$restaurant->direccion}}</span> - <a href="{{ $restaurant->google_maps }}" target="_blank">Ver en mapa</a>
                                    @else
                                        {{$restaurant->direccion}}
                                    @endif
                                </div>
                                <!-- <div class="col-xl-8 col-lg-7 col-md-6">
                                    <div class="buttons clearfix">
                                        <a id="boton_para_favorito" onclick="guardarEnLocalStorage(event)" data-restaurantid="{{ $restaurant->id }}" href="#" class="btn_hero wishlist"><i class="icon_heart"></i>Agregar a favoritos</a>
                                    </div>
                                </div> -->
                                <span class="d-block d-flex align-items-center">
                                    <p class=" d-flex align-items-center" style="flex-wrap: wrap;">
                                        @if($restaurant->telefono)
                                            <a class="telefono btnTelefono icon" href="tel:{{ $restaurant->telefono }}">
                                                <span href="#"> {{ $restaurant->telefono }} Llamar</span>
                                            </a>
                                        @endif

                                        @if($restaurant->celular && $restaurant->telefono)
                                            <span class="mr-3">
                                                o
                                            </span>
                                        @endif
                                        @if ($restaurant->celular)

                                            <a target="_blank" title="Ir a Whatsapp" href="https://api.whatsapp.com/send?phone=34{{ $restaurant->celular }}" >
                                                <img class="img-fluid" style="max-width: 40px;" src="{{ asset('plantilla/img/whatsapp.png') }}" alt="Logo de Whatsapp">
                                            </a>
                                        @endif
                                    </p>
                                </span>
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
                            @foreach($restaurant->categorias as $categoria)
                                @if($loop->index==0)
                                    <li class="nav-item">
                                        <a id="tab-{{$loop->index}}" href="#cont{{$loop->index}}" class="navigation__link nav-link active ancla">{{$categoria}}</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a id="tab-{{$loop->index}}" href="#cont{{$loop->index}}" class="navigation__link nav-link ancla">{{$categoria}}</a>
                                    </li>
                                @endif
                            @endforeach
		                </ul>

		                <div class="tab-content" role="tablist">

		                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
		                        <div role="tabpanel" aria-labelledby="heading-A">
		                            <div class="card-body info_content">
                                    @foreach($restaurant->categorias as $categoria)
                                        <div class="main_title page-section" id="cont{{$loop->index}}">
                                            <span><em></em></span>
                                            <h2>{{$categoria}}</h2>
                                        </div>

                                        <div class="row observable">
                                            @foreach($platos as $plato)
                                                @if($plato->categoria==$categoria)
                                                    <div class="col-md-4">
                                                        <div class="item">
                                                            <div class="strip">
                                                                <a href="#">
                                                                    <a  @click="itemClicado('entrantes', '{{ $plato->id }}', '{{asset('public'.$plato->imagen)}}', '{{ $plato->nombre }}', '{{ $plato->precio }}', {{json_encode($plato->descripcion)}}, {{$plato->alergenos}}, '{{$plato->precios}}','{{$plato->presentacion}}')" href="#" class="strip_info" >
                                                                        <img  loading="lazy" src="{{asset('public'.$plato->imagen)}}" class="owl-lazy plate-100" alt="">
                                                                        <div class="item_title_ind">
                                                                            <?php
                                                                                $alergenoPlato=json_decode($plato->alergenos);
                                                                            ?>
                                                                            <h3>{{ $plato->nombre }}</h3>
                                                                            <div class="cont-alergenos-sec">

                                                                                @foreach($alergenoPlato as $alergeno)
                                                                                    @if($alergeno=='15' || $alergeno=='16')
                                                                                    @else
                                                                                        <span class="cont-info-alergenos">
                                                                                            <img class="img-alergenos-sec" src="{{asset('public/images/alergenos/'.$alergeno)}}.png">
                                                                                            <h6>{{$nombreAlergenos[$alergeno-1]}}</h6>
                                                                                        </span>
                                                                                    @endif
                                                                                @endforeach
                                                                                <span class="ml-5">
                                                                                    @foreach($alergenoPlato as $alergeno)
                                                                                        @if($alergeno=='15' || $alergeno=='16')
                                                                                            <img class="img-icons-a" src="{{asset('public/images/alergenos/'.$alergeno)}}.png">
                                                                                        @endif
                                                                                    @endforeach
                                                                                </span>
                                                                            </div>
                                                                        
                                                                            
                                                                            <?php
                                                                                if ($plato->precios == NULL){
                                                                                    ?>
                                                                                    <span>{{ $plato->precio }} €</span>
                                                                            <?php
                                                                                } else {
                                                                                    $array = explode(",",$plato->precios);
                                                                                    $array2 = explode(",",$plato->presentacion);
                                                                                    $longitud = count($array2);
                                                                                    $presentaciones = array();
                                                                                    for ($k= 0; $k < $longitud; $k++) {
                                                                                        $aux = (object) [
                                                                                            'valor' => $array[$k],
                                                                                            'name' => $array2[$k],
                                                                                          ];
                                                                                        array_push($presentaciones,$aux);
                                                                                       
                                                                                        }
                                                                                       
                                                                                    ?>
                                                                                   <div class="cont-alergenos-sec">

                                                                                   @foreach($presentaciones as $plato)
                                                                                 
                                                                                            <span class="cont-info-alergenos">
                                                                                       {{ $plato->valor }}€
                                                                                            <h5  style="font-size: 8px">{{ $plato->name }} </h5>
                                                                                        </span>
                                                                                    @endforeach
                                                                                    </div>
                                                                                <!--    @foreach($array as $plato)
                                                                                        
                                                                                   <span class="ml-5">{{ $plato }} €</span>   
                                                                                       
                                                                                    @endforeach
                                                                                    -->
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </a>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach
                                        </div>{{-- end row --}}
                                    @endforeach
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
                        <li><a href="{{route('condiciones')}}">Términos y condiciones</a></li>
                        <li><a href="{{route('privacidad')}}">Políticas de privacidad</a></li>
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
<a href="{{route('directorio')}}" class="redirect d-none"></a>

  <!-- modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="carouselExampleControls2" class="carousel slide h-100" data-ride="carousel">
                <div class="carousel-inner h-100">
                    @foreach ($imagenes as $imagen)
                        @if($loop->index==0)
                            <div class="carousel-item active h-100 img-portada">
                                <img src="{{asset('public/'.$imagen)}}" class="w-100" alt="">
                            </div>
                        @else
                            <div class="carousel-item h-100 img-portada" style="background:url({{asset('public/'.$imagen)}});">
                                <img src="{{asset('public/'.$imagen)}}" class="w-100" alt="">
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    </div>

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


	<!-- COMMON SCRIPTS -->
    <script src="{{asset('plantilla/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('plantilla/js/common_func.js')}}"></script>
    <script src="{{asset('plantilla/assets/validate.js')}}"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="{{asset('plantilla/js/sticky_sidebar.min.js')}}"></script>
    <script src="{{asset('plantilla/js/specific_detail.js')}}"></script>
	<script src="{{asset('plantilla/js/datepicker.min.js')}}"></script>
	<script src="{{asset('plantilla/js/datepicker_func_1.js')}}"></script>
	<!-- <script>

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

	</script> -->

	{{-- STARTS VUEJS --}}
	<script>

        //		const restauranteID = "{{ $restaurant->id }}";
        let modalMostrado=false;

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
					precioCantidad: 0,
                    descripcion: "",
                    alergenos:[]
				},
                nombreAlergenos:[
                    'Gluten','Crustáceos','Huevos','Pescado',
                    'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
                    'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
                    'Moluscos','Altramuces'
                ]
			},
			methods: {
				itemClicado: function (categoria, id, imagen, nombre, precio, descripcion,alergenos, precios, presentacion){
                    $("#exampleModalCenter").modal('show');
                    modalMostrado=true;
                    var str=precios;
                    var str2=presentacion;
                    const arreglo2=str2.split(",");
                    const arreglo = str.split(",");
                    this.flag=arreglo.length;
                    console.log(this.flag);
                    var presentaciones = [];
                    
                     /////HACER UN FOR QUE CUENTE CUNTAS PRESENTACIONES HAY Y CREE UN ARRAY DE OBJETOS, Y UNA VARIABLE CANTIDAD PARA CAD UNA  LUEGO CUANDO 
                    for (var i=0; i<this.flag; i++){
                        let aux = {
                            "nombre": arreglo2[i],
                            "precio": arreglo[i],
                            "cantidad":1,
                            "index":i,
                            "precioCantidad":arreglo[i]
                        }
                        presentaciones.push(aux);
                    }
                    
                    
					this.newItem = {
					    
						categoria: categoria,
						id: id,
						precios:arreglo,
						presentacion:presentaciones,
						nombrePresentacion: "",
						imagen: imagen,
						nombre: nombre,
						precioUnitario: precio,
						cantidad: 1,
						precioCantidad: precio,
                        descripcion: descripcion,
                        alergenos:alergenos,
                        nombreAlergenos:[
                            'Gluten','Crustáceos','Huevos','Pescado',
                            'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
                            'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
                            'Moluscos','Altramuces'
                        ]
					}
				},

				restarCantidad: function (i){
					if (this.newItem.presentacion[i].cantidad >= 2) {
						this.newItem.presentacion[i].cantidad--;
						this.newItem.presentacion[i].precioCantidad = Number(Math.round((this.newItem.presentacion[i].precio * this.newItem.presentacion[i].cantidad)* 100) / 100).toFixed(2);
					}
				},

				sumarCantidad: function (i){

					this.newItem.presentacion[i].cantidad++;
					this.newItem.presentacion[i].precioCantidad =Number(Math.round((this.newItem.presentacion[i].precio * this.newItem.presentacion[i].cantidad)* 100) / 100).toFixed(2);
				},

				agregarAMiLista: function (j){
				    var aux = false;
				    this.newItem.cantidad = this.newItem.presentacion[j].cantidad;
				    this.newItem.precioUnitario = this.newItem.presentacion[j].precio;
				    this.newItem.nombrePresentacion = this.newItem.presentacion[j].nombre;
				    this.newItem.precioCantidad = this.newItem.cantidad * this.newItem.precioUnitario; 
					if (this.carritoActual.length === 0) {
						this.carritoActual.push(this.newItem);
					} else {
						for (let i = 0; i < this.carritoActual.length; i++) {
							const elementoEnElcarrito = this.carritoActual[i];
							
							if (elementoEnElcarrito.id === this.newItem.id && elementoEnElcarrito.nombrePresentacion == this.newItem.nombrePresentacion) {
							    aux = true;
								this.carritoActual[i].cantidad += this.newItem.cantidad;
								this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
							} 
						}
						if (aux == false){
						    this.carritoActual.push(this.newItem);
						}
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

				restarCantidadItemDelCarrito: function(nombre, presentacion){
					for (let i = 0; i < this.carritoActual.length; i++) {
						const elemento = this.carritoActual[i];
						if (elemento.nombre === nombre && elemento.cantidad >= 2 && elemento.presentacion===presentacion) {
							//restar cantidad
							this.carritoActual[i].cantidad--;
							//restar monto total
							this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
						}
					}
				},

				sumarCantidadItemDelCarrito: function (nombre, presentacion){
					for (let i = 0; i < this.carritoActual.length; i++) {
						const elemento = this.carritoActual[i];
						if (elemento.nombre === nombre  && elemento.presentacion===presentacion) {
							//restar cantidad
							this.carritoActual[i].cantidad++;
							//restar monto total
							this.carritoActual[i].precioCantidad = this.carritoActual[i].cantidad * this.carritoActual[i].precioUnitario;
						}
					}
				}
			},
			// mounted(){
			// 	// buscamos el item en local storage:
			// 	let carritoEnLocalStorage = localStorage.getItem(`carrito-resto-${restauranteID}`);
			// 	if (!carritoEnLocalStorage) {
			// 		// no existe en local storage
			// 		localStorage.setItem(`carrito-resto-${restaurantId}`, JSON.stringify( this.carritoActual ));
			// 	} else {
			// 		this.carritoActual = JSON.parse( carritoEnLocalStorage );
			// 	}
			// },
			// watch: {
			// 	carritoActual: function(){
			// 		localStorage.setItem(`carrito-resto-${restaurantId}`, JSON.stringify( this.carritoActual ));
			// 	}
			// }
		})
	</script>

        <!-- Scroll Spy -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const mainNav=document.querySelector("#mainNav");

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const id = entry.target.previousElementSibling.getAttribute('id');
                    if (entry.intersectionRatio > 0) {
                        const element = document.querySelector(`.navigation a[href="#${id}"]`);
                        element.classList.add('active');

                        mainNav.scrollTo(element.offsetLeft+element.clientWidth/2 - (mainNav.clientWidth / 2),0)
                    } else {
                        document.querySelector(`.navigation a[href="#${id}"]`).classList.remove('active');
                    }
                })
            },{rootMargin:"-20% 0px -70% 0px"});

            // Track all sections that have an `id` applied
            document.querySelectorAll('.observable').forEach((section) => {
                observer.observe(section);
            });

            function scrollToAnchor(id){
                const yOffset = -100;
                const element = document.getElementById(id);
                const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

                window.scrollTo({top: y});
            }

            document.querySelectorAll(".navigation a").forEach(a=>{
                a.onclick=e=>{
                    e.preventDefault();
                    let id=e.target.href.split('#');
                    scrollToAnchor(id[1])
                }
            })
        });


    </script>

    <script>

    document.querySelector(".btn_contactar").onclick=e=>location.href=document.querySelector(".redirect").href;

        $('#carouselExampleControls').on('slide.bs.carousel', function (e) {
            let img=document.querySelectorAll(".img-portada")[e.from+1]
            img.style.backgroundImage=`url(${img.getAttribute("data-img")})`;
        });

        $('#exampleModalCenter').on('hide.bs.modal', function (e) {
            modalMostrado=false;
            history.pushState(null, null, window.location.pathname);
        })

        window.addEventListener('popstate', function(event) {

            if (modalMostrado == false) {
                location.href=document.querySelector(".redirect").href;
            }else {
                //history.pushState(null, null, window.location.pathname);
                $('#exampleModalCenter').modal('hide')
            }
        }, false);

        $("#modalMensaje").modal('show');
    </script>
</body>
</html>
