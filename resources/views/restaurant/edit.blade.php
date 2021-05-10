@extends('restaurant.layouts.admin')


@section('title')
    Foodzinder | Añadir restaurante
@endsection

@section('custom-links')
    <link rel="stylesheet" href="{{asset('public/css/crearRestaurante.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.css" integrity="sha512-jO9KUHlvIF4MH/OTiio0aaueQrD38zlvFde9JoEA+AQaCNxIJoX4Kjse3sO2kqly84wc6aCtdm9BIUpYdvFYoA==" crossorigin="anonymous" />
@endsection

<!-- multistep form -->
@section('content')

<h2>Editar Restaurante</h2>

<form id="msform" class="container bg-white py-3 float-left mb-3" method="POST" action="{{ route('restaurant.update',['id'=>$restaurant->id]) }}" enctype="multipart/form-data">
    @csrf
    <!-- progressbar -->
    <ul id="progressbar">
        <div class="scroll">
            <li class="active"><h6>Información general</h6></li>
            <li><h6>Características</h6></li>
            <li><h6>Tipo de restaurante</h6></li>
            <li><h6>Platos</h6></li>
            <li><h6>Imágenes</h6></li>
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
                    <input type="text" name="telefono" class="form-control" style="height:max-content;" id="telefono" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
                <label for="celular">Celular (Whatsapp)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">+34</span>
                    </div>
                    <input type="text" name="celular" class="form-control" style="height:max-content;" id="celular" aria-describedby="basic-addon3">
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
        <input type="button" name="next" class="btn btn-success m-3 float-right" value="Siguiente" />
    </div>

    <div class="sec" id="sec2">
        <h2 class="fs-title mt-3">Características</h2>
        <div class="row p-2">
            <div class="col-md-9 col-12">
                <div class="row">
                    <div class="form-group form-check col-lg-4 col-6">
                        <input name="admite_reservas" type="checkbox" {{ $restaurant->admite_reservas === 'on' ? 'checked' : '' }} class="form-check-input" id="reservas">
                        <label class="form-check-label" for="reservas">Admite Reservas</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input name="para_llevar" type="checkbox" {{ $restaurant->para_llevar === 'on' ? 'checked' : '' }} class="form-check-input" id="llevar">
                        <label class="form-check-label" for="llevar">Para llevar</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input name="domicilio" type="checkbox" {{ $restaurant->domicilio === 'on' ? 'checked' : '' }} class="form-check-input" id="domicilio">
                        <label class="form-check-label" for="domicilio">A Domicilio</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input  name="terraza_exterior" type="checkbox" {{ $restaurant->terraza_exterior === 'on' ? 'checked' : '' }} class="form-check-input" id="terraza">
                        <label class="form-check-label" for="terraza">Terraza Exterior</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input name="wifi_gratuito" type="checkbox" {{ $restaurant->wifi_gratuito === 'on' ? 'checked' : '' }} class="form-check-input" id="wifi">
                        <label class="form-check-label" for="wifi">Wifi Gratuito</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input  name="sin_gluten" type="checkbox" {{ $restaurant->sin_gluten === 'on' ? 'checked' : '' }} class="form-check-input" id="gluten">
                        <label class="form-check-label" for="gluten">Sin Glúten</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input  name="accesible" type="checkbox" {{ $restaurant->accesible === 'on' ? 'checked' : '' }} class="form-check-input" id="accesible">
                        <label class="form-check-label" for="accesible">Accesible</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input  name="admite_mascotas" type="checkbox" {{ $restaurant->admite_mascotas === 'on' ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Admite Mascotas</label>
                    </div>
                    <div class="form-group form-check col-lg-4 col-6">
                        <input  name="plastic_free" type="checkbox" {{ $restaurant->plastic_free === 'on' ? 'checked' : '' }} class="form-check-input" id="plastic">
                        <label class="form-check-label" for="plastic">Plastic Free</label>
                    </div>
                </div>
            </div>
            <div class="col">
                Soy más de
                <div class="row p-2">
                    <div class="form-group form-check col-12">
                        <input name="dulce" type="checkbox" {{ $restaurant->dulce === 'on' ? 'checked' : '' }} class="form-check-input" id="dulce">
                        <label class="form-check-label" for="dulce">Dulce</label>
                    </div>
                    <div class="form-group form-check col-12">
                        <input  name="salado" type="checkbox" {{ $restaurant->salado === 'on' ? 'checked' : '' }} class="form-check-input" id="salado">
                        <label class="form-check-label" for="salado">Salado</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="button" name="next" class="btn btn-success m-3 float-right" value="Siguiente" />
        <input type="button" name="back" class="btn btn-warning m-3 float-right" value="Anterior" />
    </div>

    <div class="sec" id="sec3">
        <h2 class="fs-title mt-3">Tipo de restaurante</h2>
        <div class="row p-2">
            <div class="col-md-3 col-6">
                <div class="row">
                    <p>Precio</p>
                    <div class="form-check form-group col-12">
                        <input name="precio1" class="form-check-input" type="checkbox" {{ $restaurant->precio1 === 'on' ? 'checked' : '' }} id="precio1">
                        <label class="form-check-label" for="precio1">
                        $
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="precio2" class="form-check-input" type="checkbox" {{ $restaurant->precio2 === 'on' ? 'checked' : '' }} id="precio2">
                        <label class="form-check-label" for="precio2">
                        $$
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="precio3" class="form-check-input" type="checkbox" {{ $restaurant->precio3 === 'on' ? 'checked' : '' }} id="precio3">
                        <label class="form-check-label" for="precio3">
                        $$$
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="row">
                    <p>Tipo de Establecimiento</p>
                    <div class="form-check form-group col-12">
                        <input name="restaurante" class="form-check-input" type="checkbox" {{ $restaurant->restaurante === 'on' ? 'checked' : '' }} id="restaurante">
                        <label class="form-check-label" for="restaurante">
                            Restaurante
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="cafeteria" class="form-check-input" type="checkbox" {{ $restaurant->cafeteria === 'on' ? 'checked' : '' }} id="cafeteria">
                        <label class="form-check-label" for="cafeteria">
                            Cafetería
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="bar" class="form-check-input" type="checkbox" {{ $restaurant->bar === 'on' ? 'checked' : '' }} id="bar">
                        <label class="form-check-label" for="bar">
                            Bar
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="restaurante_playa" class="form-check-input" type="checkbox" id="restaurante_playa">
                        <label class="form-check-label" for="restaurante_playa">
                            Restaurante Playa
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="row">
                    <p>Comidas</p>
                    <div class="form-check form-group col-12">
                        <input name="desayuno" class="form-check-input" type="checkbox" {{ $restaurant->desayuno === 'on' ? 'checked' : '' }} id="desayuno">
                        <label class="form-check-label" for="desayuno">
                            Desayuno
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="brunch" class="form-check-input" type="checkbox" {{ $restaurant->brunch === 'on' ? 'checked' : '' }} id="brunch">
                        <label class="form-check-label" for="brunch">
                            Brunch
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="almuerzo" class="form-check-input" type="checkbox" {{ $restaurant->almuerzo === 'on' ? 'checked' : '' }} id="almuerzo">
                        <label class="form-check-label" for="almuerzo">
                            Almuerzo
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="merienda" class="form-check-input" type="checkbox" {{ $restaurant->merienda === 'on' ? 'checked' : '' }} id="merienda">
                        <label class="form-check-label" for="merienda">
                            Merienda
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="cena" class="form-check-input" type="checkbox" {{ $restaurant->cena === 'on' ? 'checked' : '' }} id="cena">
                        <label class="form-check-label" for="cena">
                            Cena
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="row">
                    <p>Tipo de Cocina</p>
                    <div class="form-check form-group col-12">
                        <input name="local" class="form-check-input" type="checkbox" {{ $restaurant->local === 'on' ? 'checked' : '' }} id="local">
                        <label class="form-check-label" for="local">
                            Local
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="nacional" class="form-check-input" type="checkbox" {{ $restaurant->nacional === 'on' ? 'checked' : '' }} id="nacional">
                        <label class="form-check-label" for="nacional">
                            Nacional
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="internacional" class="form-check-input" type="checkbox" {{ $restaurant->internacional === 'on' ? 'checked' : '' }} id="internacional">
                        <label class="form-check-label" for="internacional">
                            Internacional
                        </label>
                    </div>
                    <div class="form-check form-group col-12">
                        <input name="fusion" class="form-check-input" type="checkbox" {{ $restaurant->fusion === 'on' ? 'checked' : '' }} id="fusion">
                        <label class="form-check-label" for="fusion">
                            Fusión
                        </label>
                    </div>
                </div>
            </div>{{-- END-COL --}}
        </div> {{-- END-ROW --}}
        <input type="button" name="next" class="btn btn-success m-3 float-right" value="Siguiente" />
        <input type="button" name="back" class="btn btn-warning m-3 float-right" value="Anterior" />
    </div>

    <div class="sec container-fluid" id="sec4">
        <h2 class="fs-title mt-3">Platos</h2>
        <div class="form-group form-check col-12">
            <input  name="vegetariano" type="checkbox" {{ $restaurant->vegetariano === 'on' ? 'checked' : '' }} class="form-check-input" id="Vegetariano">
            <label class="form-check-label" for="Vegetariano">Vegetariano</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="vegano" type="checkbox" {{ $restaurant->vegano === 'on' ? 'checked' : '' }} class="form-check-input" id="Vegano">
            <label class="form-check-label" for="Vegano">Vegano</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="marisco" type="checkbox" {{ $restaurant->marisco === 'on' ? 'checked' : '' }} class="form-check-input" id="Marisco">
            <label class="form-check-label" for="Marisco">Marisco</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="atun" type="checkbox" {{ $restaurant->atun === 'on' ? 'checked' : '' }} class="form-check-input" id="Atún">
            <label class="form-check-label" for="Atún">Atún</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="sushi" type="checkbox" {{ $restaurant->sushi === 'on' ? 'checked' : '' }} class="form-check-input" id="Sushi">
            <label class="form-check-label" for="Sushi">Sushi</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="pescado" type="checkbox" {{ $restaurant->pescado === 'on' ? 'checked' : '' }} class="form-check-input" id="Pescado">
            <label class="form-check-label" for="Pescado">Pescado</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="carne" type="checkbox" {{ $restaurant->carne === 'on' ? 'checked' : '' }} class="form-check-input" id="Carne">
            <label class="form-check-label" for="Carne">Carne</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="paella" type="checkbox" {{ $restaurant->paella === 'on' ? 'checked' : '' }} class="form-check-input" id="Paella">
            <label class="form-check-label" for="Paella">Paella</label>
        </div>

        <div class="form-group form-check col-12">
            <input  name="pasta" type="checkbox" {{ $restaurant->pasta === 'on' ? 'checked' : '' }} class="form-check-input" id="Pasta">
            <label class="form-check-label" for="Pasta">Pasta</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="pizza" type="checkbox" {{ $restaurant->pizza === 'on' ? 'checked' : '' }} class="form-check-input" id="Pizza">
            <label class="form-check-label" for="Pizza">Pizza</label>
        </div>
        <div class="form-group form-check col-12">
            <input  name="zumos_y_batidos" type="checkbox" {{ $restaurant->zumos_y_batidos === 'on' ? 'checked' : '' }} class="form-check-input" id="Zumos">
            <label class="form-check-label" for="Zumos">Zumos y Batidos</label>
        </div>

        <input type="button" name="next" class="btn btn-success m-3 float-right" value="Siguiente" />
        <input type="button" name="back" class="btn btn-warning m-3 float-right" value="Anterior" />
    </div>

    <div class="sec" id="sec5">
        <h2 class="fs-title mt-3">Imágenes</h2>
        <div class="row mt-3">
            <div class="col">
                <div class="input-group">
                    {{-- para recortar --}}
                    <label for="original_image" class="btn btn-success">
                        Agregar imagen +
                    </label>
                    <h6> Haz click sobre una imagen para eliminarla</h6>
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
        <input type="submit" class="btn btn-primary m-3 float-right" value="Editar restaurante" />
        <input type="button" class="btn btn-warning m-3 float-right" value="Anterior" />
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
