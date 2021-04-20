<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Registrar Restaurant</title>

  <!-- Cropper CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.css" integrity="sha512-jO9KUHlvIF4MH/OTiio0aaueQrD38zlvFde9JoEA+AQaCNxIJoX4Kjse3sO2kqly84wc6aCtdm9BIUpYdvFYoA==" crossorigin="anonymous" />

   {{-- Data Tables CSS --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

   <style>
    .imagen_izquierda_modal {
       display: block;
       max-width: 100%;
    }
    .imagen_final {
       display: block;
       max-width: 100%;
    }
    .preview_imagen_recortada {
       overflow: hidden;
       width: 1280px;
       height: 720px;
       margin: 10px;
       border: 1px solid grey;
    }

 </style>


</head>
<body>


   <div class="container fluid add_top_menu mt-5">
      <div class="row">
         <div class="col-md-12">
            <form method="POST" action="{{ route('restaurant.store') }}" enctype="multipart/form-data">
               @csrf
               <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="nombre">Nombre del Restaurant</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" required>
                  </div>
                  <div class="form-group col-md-8">
                     <label for="direccion">Dirección</label>
                     <input name="direccion" type="text" class="form-control" value="{{ old('direccion') }}" id="direccion" placeholder="C/Sant Rafael">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label for="ciudad">Ciudad</label>
                     <select required name="ciudad" id="ciudad" value="{{ old('ciudad') }}" class="form-control">
                       <option value="">-- Seleccione --</option>
                       <option value="Madrid">Madrid</option>
                       <option value="Barcelona">Barcelona</option>
                       <option value="Sevilla">Sevilla</option>
                       <option value="Bilbao">Bilbao</option>
                       <option value="Zaragoza">Zaragoza</option>
                       <option value="Granada">Granada</option>
                       <option value="Córdoba">Córdoba</option>
                       <option value="San Sebastián">San Sebastián</option>
                       <option value="Salamanca">Salamanca</option>
                       <option value="Valencia">Valencia</option>
                       <option value="Toledo">Toledo</option>
                       <option value="Burgos">Burgos</option>
                       <option value="Málaga">Málaga</option>
                       <option value="Tarifa">Tarifa</option>
                     </select>
                  </div>
                  <div class="form-group col-md-4">
                     <label for="pais">País</label>
                     <select name="pais" id="pais" class="form-control">
                       <option value="" disabled selected>-- Seleccione --</option>
                       <option value="España">España</option>
                     </select>
                  </div>
                  <div class="form-group col-md-4">

                    <label for="telefono">Teléfono</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">+34</div>
                      </div>
                      <input name="telefono" type="text" class="form-control" id="telefono" placeholder="936 3636 3625">
                    </div>

                  </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-8">
                    <label for="google_maps">Enlace a Google Maps:</label>
                    <input name="google_maps" type="text" class="form-control" value="{{ old('google_maps') }}" id="google_maps" placeholder="Ejemplo: https://goo.gl/maps/U4ovQFQCftxehew8A">
                 </div>
                 <div class="form-group col-md-4 text-center">
                    <label for="google_maps">¿Tiene WhatsApp?  </label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="tiene_whatsapp" id="checkbox_si">
                      <label class="form-check-label" for="checkbox_si">
                        SI
                      </label>
                    </div>
                 </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="google_maps">Horario de Atención:</label>
                    <input name="horario" type="text" class="form-control" value="{{ old('horario') }}" id="horario" placeholder="Ejemplo: Lunes a Viernes de 12hrs a 22hrs">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="correo">Correo electrónico:</label>
                    <input name="correo" type="email" class="form-control" value="{{ old('correo') }}" id="correo" placeholder="Correo al cual se enviarán los mensajes de contacto">
                  </div>
               </div>
               <hr>


               <div class="container">
                 <div class="row">
                   <div class="col-md-3">
                    <p>Precio</p>
                    <div class="form-check">
                      <input name="precio1" class="form-check-input" type="checkbox" id="precio1">
                      <label class="form-check-label" for="precio1">
                        $
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="precio2" class="form-check-input" type="checkbox" id="precio2">
                      <label class="form-check-label" for="precio2">
                        $$
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="precio3" class="form-check-input" type="checkbox" id="precio3">
                      <label class="form-check-label" for="precio3">
                        $$$
                      </label>
                    </div>
                   </div>


                   <div class="col-md-3">
                    <p>Tipo de Establecimiento</p>
                    <div class="form-check">
                      <input name="restaurante" class="form-check-input" type="checkbox" id="restaurante">
                      <label class="form-check-label" for="restaurante">
                        Restaurante
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="cafeteria" class="form-check-input" type="checkbox" id="cafeteria">
                      <label class="form-check-label" for="cafeteria">
                        Cafetería
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="bar" class="form-check-input" type="checkbox" id="bar">
                      <label class="form-check-label" for="bar">
                        Bar
                      </label>
                    </div>
                   </div>


                   <div class="col-md-3">
                    <p>Comidas</p>
                    <div class="form-check">
                      <input name="desayuno" class="form-check-input" type="checkbox" id="desayuno">
                      <label class="form-check-label" for="desayuno">
                        Desayuno
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="brunch" class="form-check-input" type="checkbox" id="brunch">
                      <label class="form-check-label" for="brunch">
                        Brunch
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="almuerzo" class="form-check-input" type="checkbox" id="almuerzo">
                      <label class="form-check-label" for="almuerzo">
                        Almuerzo
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="merienda" class="form-check-input" type="checkbox" id="merienda">
                      <label class="form-check-label" for="merienda">
                        Merienda
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="cena" class="form-check-input" type="checkbox" id="cena">
                      <label class="form-check-label" for="cena">
                        Cena
                      </label>
                    </div>
                   </div>


                   <div class="col-md-3">
                    <p>Tipo de Cocina</p>
                    <div class="form-check">
                      <input name="local" class="form-check-input" type="checkbox" id="local">
                      <label class="form-check-label" for="local">
                        Local
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="nacional" class="form-check-input" type="checkbox" id="nacional">
                      <label class="form-check-label" for="nacional">
                        Nacional
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="internacional" class="form-check-input" type="checkbox" id="internacional">
                      <label class="form-check-label" for="internacional">
                        Internacional
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="fusion" class="form-check-input" type="checkbox" id="fusion">
                      <label class="form-check-label" for="fusion">
                        Fusión
                      </label>
                    </div>
                   </div>{{-- END-COL --}}
                 </div> {{-- END-ROW --}}

                 <hr>

                 <div class="row">
                   <div class="col-md-4">
                    <p>Características</p>
                    <div class="form-check">
                      <input name="admite_reservas" class="form-check-input" type="checkbox" id="admite_reservas">
                      <label class="form-check-label" for="admite_reservas">
                        Admite Reservas
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="para_llevar" class="form-check-input" type="checkbox" id="para_llevar">
                      <label class="form-check-label" for="para_llevar">
                        Para LLevar
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="domicilio" class="form-check-input" type="checkbox" id="domicilio">
                      <label class="form-check-label" for="domicilio">
                        A Domicilio
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="terraza_exterior" class="form-check-input" type="checkbox" id="terraza_exterior">
                      <label class="form-check-label" for="terraza_exterior">
                        Terraza Exterior
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="wifi_gratuito" class="form-check-input" type="checkbox" id="wifi_gratuito">
                      <label class="form-check-label" for="wifi_gratuito">
                        Wifi Gratuito
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="sin_gluten" class="form-check-input" type="checkbox" id="sin_gluten">
                      <label class="form-check-label" for="sin_gluten">
                        Sin Glúten
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="accesible" class="form-check-input" type="checkbox" id="accesible">
                      <label class="form-check-label" for="accesible">
                        Accesible
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="admite_mascotas" class="form-check-input" type="checkbox" id="admite_mascotas">
                      <label class="form-check-label" for="admite_mascotas">
                        Admite Mascotas
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="plastic_free" class="form-check-input" type="checkbox" id="plastic_free">
                      <label class="form-check-label" for="plastic_free">
                        Plastic Free
                      </label>
                    </div>
                   </div>


                   <div class="col-md-4">
                    <p>Soy más de</p>
                    <div class="form-check">
                      <input name="dulce" class="form-check-input" type="checkbox" id="dulce">
                      <label class="form-check-label" for="dulce">
                        Dulce
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="salado" class="form-check-input" type="checkbox" id="salado">
                      <label class="form-check-label" for="salado">
                        Salado
                      </label>
                    </div>
                   </div>

                   <div class="col-md-4">
                    <p>Platos</p>
                    <div class="form-check">
                      <input name="vegetariano" class="form-check-input" type="checkbox" id="vegetariano">
                      <label class="form-check-label" for="vegetariano">
                        Vegetariano
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="vegano" class="form-check-input" type="checkbox" id="vegano">
                      <label class="form-check-label" for="vegano">
                        Vegano
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="marisco" class="form-check-input" type="checkbox" id="marisco">
                      <label class="form-check-label" for="marisco">
                        Marisco
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="atun" class="form-check-input" type="checkbox" id="atun">
                      <label class="form-check-label" for="atun">
                        Atún
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="sushi" class="form-check-input" type="checkbox" id="sushi">
                      <label class="form-check-label" for="sushi">
                        Sushi
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="pescado" class="form-check-input" type="checkbox" id="pescado">
                      <label class="form-check-label" for="pescado">
                        Pescado
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="carne" class="form-check-input" type="checkbox" id="carne">
                      <label class="form-check-label" for="carne">
                        Carne
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="paella" class="form-check-input" type="checkbox" id="paella">
                      <label class="form-check-label" for="paella">
                        Paella
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="pasta" class="form-check-input" type="checkbox" id="pasta">
                      <label class="form-check-label" for="pasta">
                        Pasta
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="pizza" class="form-check-input" type="checkbox" id="pizza">
                      <label class="form-check-label" for="pizza">
                        Pizza
                      </label>
                    </div>
                    <div class="form-check">
                      <input name="zumos_y_batidos" class="form-check-input" type="checkbox" id="zumos_y_batidos">
                      <label class="form-check-label" for="zumos_y_batidos">
                        Zumos y Batidos
                      </label>
                    </div>
                   </div>{{-- END-COL --}}
                 </div>{{-- END-ROW --}}

                 <div class="row mt-3">
                   <div class="col text-center m-4">
                     <h3>Imágen/es Para Portada del Restaurante:</h3>
                   </div>
                  </div>
                   <div class="row">
                    <div class="col">
                      <div class="input-group">
                        {{-- para recortar --}}
                        <label for="original_image" class="btn btn-success">
                            Agregar imagen +
                        </label>
                        <h6> Haz click sobre una imagen para eliminarla</h6>
                        <input id="original_image" style="display:none;" type="file" name="imagen"  class="form-control">

                        {{-- recortado (oculto) --}}
                        <input id="imagen1" type="text" name="filenames" class="form-control d-none" required>
                      </div>
                    </div>
                  </div>
                  <div class="row m-2 p-1">
                    <div class="col-md-12">
                        <div class="coleccionImg"></div>
                      <img class="imagen_final" id="imagen_final" src="" alt="" style="display:none;">
                    </div>
                  </div>

               </div> {{-- END-CONTAINER --}}

               <div class="container mt-3">
                 <div class="row">
                   <div class="col">
                     <button type="submit" class="btn btn-success">Registrar Restaurant</button>
                     <a href="{{ url('/') }}">
                       <button type="button" class="btn btn-primary">Página de inicio</button>
                     </a>

                   </div>
                 </div>
               </div>
            </form>
         </div>
      </div>
      <hr>
   </div>


   <div class="container mt-5">
     <div class="row">
      <div class="col text-center">
        <h4>Restaurantes Registrados:</h4>
       </div>
     </div>
     <div class="row">
       <div class="col">
        <table id="tabla_listado_restaurantes" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Restaurant</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Status</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($restaurantes as $resto)
            <tr>
              <td class="text-center">
                <a href="{{ url('/restaurant/show/'.$resto->id) }}">{{ $resto->nombre }}</a>
              </td>
              <td class="text-center">{{ $resto->direccion }}</td>
              <td class="text-center">{{ $resto->telefono }}</td>
              <td class="text-center">{{ $resto->status === "1" ? "Habilitado" : "No aparecerá en el buscador" }}</td>
              <td class="text-center d-flex justify-content-center">
                <a class="m-1" href="{{ route('restaurant.edit', ['id' => $resto->id]) }}">
                  <button type="button" class="btn btn-success btn-sm">Editar Restaurante</button>
                </a>
                <a class="m-1" href="{{ route('categorias.index', ['id' => $resto->id]) }}">
                  <button type="button" class="btn btn-info btn-sm">Ver Categorías</button>
                </a>

                <a class="m-1" href="{{ route('restaurant.cambiar_status', ['id' => $resto->id]) }}">
                  <button type="button" class="btn btn-{{ $resto->status === "2" ? "success" : "danger" }} btn-sm">{{ $resto->status === "1" ? "Inhabilitar" : "Habilitar" }}</button>
                </a>

              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Restaurant</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Status</th>
                <th>Acciones</th>
              </tr>
          </tfoot>
      </table>


       </div>
     </div>
   </div>

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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Cropper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js" integrity="sha512-1bpfZkKJ+WlmJN/I2KLm79dSiuOos0ymwL5IovsUVARyzcaf9rSXsVO2Cdg4qlKNOQXh8fd1d0vKeY9Ru3bQDw==" crossorigin="anonymous"></script>

    {{-- Data Tables JS --}}
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function() {
          let arrImg=[];
          let coleccionImg=document.querySelector(".coleccionImg");
        $('#tabla_listado_restaurantes').DataTable();

        // Escucha el evento que surge cuando el source de la imagen cambia:
        let img = document.querySelector("#imagen_final"),
        observer = new MutationObserver((changes) => {
          changes.forEach(change => {
              if(change.attributeName.includes('src')){
                  const imgDom=document.createElement("img");
                  imgDom.setAttribute("src",img.src);
                  imgDom.className="img-coleccion col-md-4 col-sm-6 img-fluid my-1";
                  coleccionImg.appendChild(imgDom);
                  arrImg.push(img.src);
                  const urlImg=img.src;
                  document.querySelector('#imagen1').value = JSON.stringify(arrImg);
                  console.log(document.querySelector('#imagen1').value)
                imgDom.onclick=()=>{
                    coleccionImg.removeChild(imgDom);
                    arrImg=arrImg.filter(ele=>ele!==urlImg);
                    document.querySelector('#imagen1').value = JSON.stringify(arrImg);
                }
              }
          });
        });
        observer.observe(img, {attributes : true});

      });


      // CROPPER
      var bs_modal = $('#ventanaModal');
         var image = document.getElementById('imagen_original_visualizada');
         var cropper, reader, file;

         $('body').on("change", "#original_image", function (e) {
            var files = e.target.files;
            var done = function(url){
               image.src = url;
               bs_modal.modal('show');
            };

            if (files && files.length > 0) {
               file = files[0];

               if (URL) {
                  done(URL.createObjectURL(file));
               } else if(FileReader) {
                  reader = new FileReader();
                  reader.onload = function(e){
                     done(reader.result);
                  };
                  reader.readAsDataURL(file);
               }
            }
         });

         bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
               aspectRatio: 16/9,
               viewmode: 3,
               preview: ".preview_imagen_recortada",
            });
         }).on('hidden.bs.modal', function() {
            document.getElementById("original_image").value = "";
            cropper.destroy();
            cropper = null;
         });

         $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
               width: 1280,
               height: 720
            })

            canvas.toBlob(function(blob) {
               url = URL.createObjectURL(blob);
               var reader = new FileReader();
               reader.readAsDataURL(blob);
               reader.onloadend = function() {
                  var base64data = reader.result;
                  document.getElementById('imagen_final').src = base64data;
                  bs_modal.modal('hide');
               };
            })
         });
    </script>
</body>
</html>
