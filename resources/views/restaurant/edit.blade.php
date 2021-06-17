@extends('restaurant.layouts.admin')


@section('title')
    Foodzinder | Añadir restaurante
@endsection

@section('custom-links')
    <link rel="stylesheet" href="{{asset('public/css/crearRestaurante.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.css" integrity="sha512-jO9KUHlvIF4MH/OTiio0aaueQrD38zlvFde9JoEA+AQaCNxIJoX4Kjse3sO2kqly84wc6aCtdm9BIUpYdvFYoA==" crossorigin="anonymous" />
    <style>
        #app{
            display: flex;
        }
    </style>
@endsection

<!-- multistep form -->
@section('content')

<div class="cont-botones-nav">
    <a href="#" class="active">
        <i class="fa fa-address-card-o" aria-hidden="true"></i>
        <span>Editar información</span>
    </a>
    <a href="{{ route('categorias.index', ['id' => $restaurant->id]) }}">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
        <span>Editar Menú</span>
    </a>
</div>

<form id="msform" class="container py-3 float-left mb-3" method="POST" action="{{ route('restaurant.update',['id'=>$restaurant->id]) }}" enctype="multipart/form-data">
    <h2 class="mb-4">{{$restaurant->nombre}}</h2>
    @csrf
    <!-- progressbar -->
    <ul id="progressbar">
        <div class="scroll">
            <li id="0" class="active"><h6>Información general</h6></li>
            <li id="1"><h6>Características</h6></li>
            <li id="2"><h6>Tipo de restaurante</h6></li>
            <li id="3"><h6>Platos</h6></li>
            <li id="4"><h6>Imágenes</h6></li>
        </div>
    </ul>
    <!-- fieldsets -->
    <div class="sec sec_active" id="sec1">
        <h2 class="fs-title mt-3">Información general</h2>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre del restaurante</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{$restaurant->nombre}}">
            </div>
            <div class="form-group col-md-6">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion"  class="form-control" id="direccion" value="{{$restaurant->direccion}}">
            </div>
            <div class="form-group col-md-4 col-sm-6">
                <label for="pais">País</label>
                <select  name="pais" class="form-control" id="pais">
                    <option>España</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-sm-6">
                <label for="ciudad">Ciudad</label>
                <select  name="ciudad" class="form-control" id="ciudad" value="{{$restaurant->ciudad}}">
                <option {{ $restaurant->ciudad === '' ? 'selected' : '' }} value="">-- Seleccione --</option>
                       <option {{ $restaurant->ciudad === 'Madrid' ? 'selected' : '' }} value="Madrid">Madrid</option>
                       <option {{ $restaurant->ciudad === 'Barcelona' ? 'selected' : '' }} value="Barcelona">Barcelona</option>
                       <option {{ $restaurant->ciudad === 'Sevilla' ? 'selected' : '' }} value="Sevilla">Sevilla</option>
                       <option {{ $restaurant->ciudad === 'Bilbao' ? 'selected' : '' }} value="Bilbao">Bilbao</option>
                       <option {{ $restaurant->ciudad === 'Zaragoza' ? 'selected' : '' }} value="Zaragoza">Zaragoza</option>
                       <option {{ $restaurant->ciudad === 'Granada' ? 'selected' : '' }} value="Granada">Granada</option>
                       <option {{ $restaurant->ciudad === 'Cordoba' ? 'selected' : '' }} value="Cordoba">Córdoba</option>
                       <option {{ $restaurant->ciudad === 'San Sebastián' ? 'selected' : '' }} value="San Sebastián">San Sebastián</option>
                       <option {{ $restaurant->ciudad === 'Salamanca' ? 'selected' : '' }} value="Salamanca">Salamanca</option>
                       <option {{ $restaurant->ciudad === 'Valencia' ? 'selected' : '' }} value="Valencia">Valencia</option>
                       <option {{ $restaurant->ciudad === 'Toledo' ? 'selected' : '' }} value="Toledo">Toledo</option>
                       <option {{ $restaurant->ciudad === 'Burgos' ? 'selected' : '' }} value="Burgos">Burgos</option>
                       <option {{ $restaurant->ciudad === 'Malaga' ? 'selected' : '' }} value="Malaga">Málaga</option>
                       <option {{ $restaurant->ciudad === 'Tarifa' ? 'selected' : '' }} value="Tarifa">Tarifa</option>
                    <option {{ $restaurant->ciudad === 'Bolonia, Cádiz' ? 'selected' : '' }} value="Bolonia, Cádiz">Bolonia, Cádiz</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-sm-6">
                <label for="telefono">Teléfono</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">+34</span>
                    </div>
                    <input type="text" name="telefono" class="form-control" value="{{$restaurant->telefono}}" style="height:max-content;" id="telefono" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
                <label for="celular">Celular (Whatsapp)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">+34</span>
                    </div>
                    <input type="text" name="celular" class="form-control" value="{{$restaurant->celular}}" style="height:max-content;" id="celular" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="ciudadd">Horario de atención</label>
                <input  name="horario" type="text" class="form-control" id="ciudadd">
            </div>
            <div class="form-group col-md-8">
                <label for="google_maps">Enlace a Google Maps:</label>
                <input name="google_maps" type="text" class="form-control" value="{{$restaurant->google_maps}}" id="google_maps" placeholder="Ejemplo: https://goo.gl/maps/U4ovQFQCftxehew8A">
            </div>
        </div>
        <input type="submit" class="btn btn-guardar m-3 float-right" value="Guardar" />
    </div>

    <div class="sec" id="sec2">
        <h2 class="fs-title mt-3">Características</h2>
        <div class="row p-2">
            <div class="col-12">
                <div class="row">
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input name="admite_reservas" type="checkbox" {{ $restaurant->admite_reservas === 'on' ? 'checked' : '' }} class="form-check-input" id="reservas">
                        <label class="form-check-label" for="reservas">
                            <img src="{{ asset('plantilla/img/filtros_img/admite-reservas.png') }}">
                            Admite Reservas
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input name="para_llevar" type="checkbox" {{ $restaurant->para_llevar === 'on' ? 'checked' : '' }} class="form-check-input" id="llevar">
                        <label class="form-check-label" for="llevar">
                            <img src="{{ asset('plantilla/img/filtros_img/para-llevar.png') }}">
                            Para llevar</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input name="domicilio" type="checkbox" {{ $restaurant->domicilio === 'on' ? 'checked' : '' }} class="form-check-input" id="domicilio">
                        <label class="form-check-label" for="domicilio">
                            <img src="{{ asset('plantilla/img/filtros_img/a-domicilio.png') }}">
                            A Domicilio
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input  name="terraza_exterior" type="checkbox" {{ $restaurant->terraza_exterior === 'on' ? 'checked' : '' }} class="form-check-input" id="terraza">
                        <label class="form-check-label" for="terraza">
                            <img src="{{ asset('plantilla/img/filtros_img/terraza-exterior.png') }}">
                            Terraza Exterior
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input name="wifi_gratuito" type="checkbox" {{ $restaurant->wifi_gratuito === 'on' ? 'checked' : '' }} class="form-check-input" id="wifi">
                        <label class="form-check-label" for="wifi">
                            <img src="{{ asset('plantilla/img/filtros_img/wifi-gratis.png') }}">
                            Wifi Gratuito
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input  name="sin_gluten" type="checkbox" {{ $restaurant->sin_gluten === 'on' ? 'checked' : '' }} class="form-check-input" id="gluten">
                        <label class="form-check-label" for="gluten">
                            <img src="{{ asset('plantilla/img/filtros_img/gluten-free.png') }}">
                            Sin Glúten
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input  name="accesible" type="checkbox" {{ $restaurant->accesible === 'on' ? 'checked' : '' }} class="form-check-input" id="accesible">
                        <label class="form-check-label" for="accesible">
                            <img src="{{ asset('plantilla/img/filtros_img/accesible.png') }}">
                            Accesible
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input  name="admite_mascotas" type="checkbox" {{ $restaurant->admite_mascotas === 'on' ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">
                            <img src="{{ asset('plantilla/img/filtros_img/admite-mascotas.png') }}">
                            Admite Mascotas
                        </label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6 caracteristicas">
                        <input  name="plastic_free" type="checkbox" {{ $restaurant->plastic_free === 'on' ? 'checked' : '' }} class="form-check-input" id="plastic">
                        <label class="form-check-label" for="plastic">
                            <img src="{{ asset('plantilla/img/filtros_img/plastic-free.png') }}">
                            Plastic Free
                        </label>
                    </div>
                </div>
            </div>

        </div>
                <input type="submit" class="btn btn-guardar m-3 float-right" value="Guardar" />
    </div>

    <div class="sec" id="sec3">
        <h2 class="fs-title mt-3">Tipo de restaurante</h2>
        <div class="row p-2 cont-tipos">
            <div class="row">
                <p class="title-tipo">Precio</p>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="precio1">
                        <input name="precio1" class="form-check-input d-none" type="checkbox" {{ $restaurant->precio1 === 'on' ? 'checked' : '' }} id="precio1">
                        <span class="checkmark"></span>
                        <span>Bajo ($)</span>
                    </label>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="precio2">
                        <input name="precio2" class="form-check-input d-none" type="checkbox" {{ $restaurant->precio2 === 'on' ? 'checked' : '' }} id="precio2">
                        <span class="checkmark"></span>
                        <span>Medio ($$)</span>
                    </label>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="precio3">
                        <input name="precio3" class="form-check-input d-none" type="checkbox" {{ $restaurant->precio3 === 'on' ? 'checked' : '' }} id="precio3">
                        <span class="checkmark"></span>
                        <span>Alto ($$$)</span>
                    </label>
                </div>
            </div>
            <div class="row">
               <p class="title-tipo">
                   Sabores
               </p>
                <div class="row p-2 ">
                    <div class="form-group form-check">
                        <label class="form-check-label container_check" for="dulce">
                            <input name="dulce" type="checkbox" {{ $restaurant->dulce === 'on' ? 'checked' : '' }} class="form-check-input" id="dulce">
                            <span class="checkmark"></span>
                            Dulce
                        </label>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label container_check" for="salado">
                            <input name="salado" type="checkbox" {{ $restaurant->salado === 'on' ? 'checked' : '' }} class="form-check-input" id="salado">
                            <span class="checkmark"></span>
                            Salado
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="title-tipo"> Tipo de Establecimiento</p>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="restaurante">
                        <input name="restaurante" class="form-check-input" type="checkbox" {{ $restaurant->restaurante === 'on' ? 'checked' : '' }} id="restaurante">
                        <span class="checkmark"></span>
                        Restaurante
                    </label>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="cafeteria">
                        <input name="cafeteria" class="form-check-input" type="checkbox" {{ $restaurant->cafeteria === 'on' ? 'checked' : '' }} id="cafeteria">
                        <span class="checkmark"></span>
                        Cafetería
                    </label>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="bar">
                        <input name="bar" class="form-check-input" type="checkbox" {{ $restaurant->bar === 'on' ? 'checked' : '' }} id="bar">
                        <span class="checkmark"></span>
                        Bar
                    </label>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label container_check" for="restaurante_playa">
                        <input name="restaurante_playa" class="form-check-input" type="checkbox" id="restaurante_playa">
                        <span class="checkmark"></span>
                        Restaurante Playa
                    </label>
                </div>
            </div>
            <div class="row">
                <p class="title-tipo">Comidas</p>
                <div class="row">
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="desayuno">
                            <input name="desayuno" class="form-check-input" type="checkbox" {{ $restaurant->desayuno === 'on' ? 'checked' : '' }} id="desayuno">
                            <span class="checkmark"></span>
                            Desayuno
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="brunch">
                            <input name="brunch" class="form-check-input" type="checkbox" {{ $restaurant->brunch === 'on' ? 'checked' : '' }} id="brunch">
                            <span class="checkmark"></span>
                            Brunch
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="almuerzo">
                            <input name="almuerzo" class="form-check-input" type="checkbox" {{ $restaurant->almuerzo === 'on' ? 'checked' : '' }} id="almuerzo">
                            <span class="checkmark"></span>
                            Almuerzo
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="merienda">
                            <input name="merienda" class="form-check-input" type="checkbox" {{ $restaurant->merienda === 'on' ? 'checked' : '' }} id="merienda">
                            <span class="checkmark"></span>
                            Merienda
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="cena">
                            <input name="cena" class="form-check-input" type="checkbox" {{ $restaurant->cena === 'on' ? 'checked' : '' }} id="cena">
                            <span class="checkmark"></span>
                            Cena
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="title-tipo">Tipo de Cocina</p>
                <div class="row">
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="local">
                            <input name="local" class="form-check-input" type="checkbox" {{ $restaurant->local === 'on' ? 'checked' : '' }} id="local">
                            <span class="checkmark"></span>
                            Local
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="nacional">
                            <input name="nacional" class="form-check-input" type="checkbox" {{ $restaurant->nacional === 'on' ? 'checked' : '' }} id="nacional">
                            <span class="checkmark"></span>
                            Nacional
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="internacional">
                            <input name="internacional" class="form-check-input" type="checkbox" {{ $restaurant->internacional === 'on' ? 'checked' : '' }} id="internacional">
                            <span class="checkmark"></span>
                            Internacional
                        </label>
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label container_check" for="fusion">
                            <input name="fusion" class="form-check-input" type="checkbox" {{ $restaurant->fusion === 'on' ? 'checked' : '' }} id="fusion">
                            <span class="checkmark"></span>
                            Fusión
                        </label>
                    </div>
                </div>
            </div>{{-- END-COL --}}
        </div> {{-- END-ROW --}}
                <input type="submit" class="btn btn-guardar m-3 float-right" value="Guardar" />
    </div>

    <div class="sec container-fluid" id="sec4">
        <h2 class="fs-title mt-3">Platos</h2>
        <div class="row">
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="vegetariano" type="checkbox" {{ $restaurant->vegetariano === 'on' ? 'checked' : '' }} class="form-check-input" id="Vegetariano">
                <label class="form-check-label" for="Vegetariano">Vegetariano</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="vegano" type="checkbox" {{ $restaurant->vegano === 'on' ? 'checked' : '' }} class="form-check-input" id="Vegano">
                <label class="form-check-label" for="Vegano">Vegano</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="marisco" type="checkbox" {{ $restaurant->marisco === 'on' ? 'checked' : '' }} class="form-check-input" id="Marisco">
                <label class="form-check-label" for="Marisco">Marisco</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="atun" type="checkbox" {{ $restaurant->atun === 'on' ? 'checked' : '' }} class="form-check-input" id="Atún">
                <label class="form-check-label" for="Atún">Atún</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="sushi" type="checkbox" {{ $restaurant->sushi === 'on' ? 'checked' : '' }} class="form-check-input" id="Sushi">
                <label class="form-check-label" for="Sushi">Sushi</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="pescado" type="checkbox" {{ $restaurant->pescado === 'on' ? 'checked' : '' }} class="form-check-input" id="Pescado">
                <label class="form-check-label" for="Pescado">Pescado</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="carne" type="checkbox" {{ $restaurant->carne === 'on' ? 'checked' : '' }} class="form-check-input" id="Carne">
                <label class="form-check-label" for="Carne">Carne</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="paella" type="checkbox" {{ $restaurant->paella === 'on' ? 'checked' : '' }} class="form-check-input" id="Paella">
                <label class="form-check-label" for="Paella">Paella</label>
            </div>

            <div class="form-group form-check col-3 caracteristicas">
                <input  name="pasta" type="checkbox" {{ $restaurant->pasta === 'on' ? 'checked' : '' }} class="form-check-input" id="Pasta">
                <label class="form-check-label" for="Pasta">Pasta</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="pizza" type="checkbox" {{ $restaurant->pizza === 'on' ? 'checked' : '' }} class="form-check-input" id="Pizza">
                <label class="form-check-label" for="Pizza">Pizza</label>
            </div>
            <div class="form-group form-check col-3 caracteristicas">
                <input  name="zumos_y_batidos" type="checkbox" {{ $restaurant->zumos_y_batidos === 'on' ? 'checked' : '' }} class="form-check-input" id="Zumos">
                <label class="form-check-label" for="Zumos">Zumos y Batidos</label>
            </div>
        </div>
                <input type="submit" class="btn btn-guardar m-3 float-right" value="Guardar" />
    </div>

    <div class="sec" id="sec5">
        <h2 class="fs-title mt-3">Fotos del restaurante</h2>
        <div class="row mt-3">
            <div class="col">
                <div class="input-group">
                    {{-- para recortar --}}
                    <label for="original_image" class="btn btn-guardar">
                        Agregar imagen +
                    </label><br>
                    <h6 style="color:gray; width:100%;"> Haz click sobre una imagen para eliminarla</h6>
                    <input id="original_image" style="display:none;" type="file" name="imagen"  class="form-control">
                    {{-- recortado (oculto) --}}
                    <input id="imagen1" type="text" name="filenames" class="form-control d-none">
                </div>
            </div>
            <div class="row m-2 p-1">
                <div class="col-md-12">
                    <input type="hidden" name="imagenes" class="valuesImg" value="{{$restaurant->imagenes}}">
                    <div class="coleccionImg">
                        <?php $arrImg=json_decode($restaurant->imagenes); ?>
                        @foreach($arrImg as $img)
                            <img alt="{{$img}}" src="{{asset('public/'.$img)}}" class="img-coleccion col-md-4 col-sm-6 img-fluid my-1" onclick="quitarImgOri(this)">
                        @endforeach
                    </div>
                    <img class="imagen_final" id="imagen_final" src="" alt="" style="display:none;">
                </div>
            </div>
        </div> {{-- END-CONTAINER --}}
        <input type="submit" class="btn btn-guardar m-3 float-right" value="Guardar" />
    </div>
</form>

   <!-- Modal -->
   <div class="modal fade" id="ventanaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Seleccione el área de la imágen final</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
             <div class="row">
                <div class="col-md-8">
                   <img class="imagen_izquierda_modal" id="imagen_original_visualizada" src="" alt="">
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                   <div class="preview_imagen_recortada"></div>
                </div>
             </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
             <button id="crop" type="button" class="btn btn-primary">Recortar</button>
          </div>
       </div>
    </div>
 </div>
 <!-- Modal -->
@endsection

@section('scripts')
    <!-- Cropper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js" integrity="sha512-1bpfZkKJ+WlmJN/I2KLm79dSiuOos0ymwL5IovsUVARyzcaf9rSXsVO2Cdg4qlKNOQXh8fd1d0vKeY9Ru3bQDw==" crossorigin="anonymous"></script>
    <!--custom js-->
    <script src="{{asset('public/js/editarRestaurante.js')}}"></script>
@endsection
