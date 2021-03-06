@extends('restaurant.layouts.admin')

@section('custom-links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.css" integrity="sha512-jO9KUHlvIF4MH/OTiio0aaueQrD38zlvFde9JoEA+AQaCNxIJoX4Kjse3sO2kqly84wc6aCtdm9BIUpYdvFYoA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('public/css/categorias.css')}}">
    <style>
        #app{
            display: flex;
            padding-right: 4rem;
        }

        @media (max-width:1200px){
            #app{
                flex-direction: column;
            }

            .cont-botones-nav{
                flex-direction: row;
            }
        }
    </style>
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<div class="container mt-4">
    <div class="cont-botones-nav">
    <a href="{{ route('restaurant.edit', ['id' => $restaurante->id]) }}">
        <i class="fa fa-address-card-o" aria-hidden="true"></i>
        <span>Editar información</span>
    </a>
    <a href="#"  class="active">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
        <span>Editar Menú</span>
    </a>
</div>
    <div class="row justify-content-center">
        <h3>Restaurante:</h3>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input disabled name="nombre" type="text" value="{{$restaurante->nombre}}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="direccion">Dirección</label>
                    <input disabled name="direccion" type="text" class="form-control" value="{{$restaurante->direccion}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">+34</div>
                        </div>
                        <input disabled value="{{$restaurante->telefono}}" name="telefono" type="text" class="form-control" id="telefono">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col text-right">
            <button class="btn btn-primary btn-sm btn-ordenar-imagenes" data-toggle="modal" data-target="#ordenImagenesModal" >Ordenar imágenes del menú</button>
            <button class="btn btn-info btn-sm btn-agregar-categoria" data-toggle="modal" data-target="#exampleModal" >Agregar categoría</button>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="msform" method="POST" action="{{ route('categorias.agregarCategoria')}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre de la categoría:</label>
                                <input type="text" class="form-control" id="recipient-name" name="categoria" required>
                                <input type="hidden" name="id" value="{{$restaurante->id}}">
                            <small id="categoriaHelp" class="form-text text-muted">Asegúrese de escribir el nombre de la categoría sin errores ortográficos, con la primera letra en mayúscula.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ordenImagenesModal" tabindex="-1" role="dialog" aria-labelledby="ordenImagenesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form id="msform" method="POST" action="{{ route('restaurant.organizarImgs',['restauranteId'=>$restaurante->id])}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ordenImagenesModalLabel">Ordenar imágenes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Seleccione las imágenes que deben salir en los resultados de búsqueda. Máximo 4.</p>
                        @foreach($platos as $plato)
                        <span>
                            <input type="checkbox" id="img{{$loop->index}}" class="checkImg" data-id="{{'posImg'.$loop->index}}">
                            <label for="img{{$loop->index}}" class="img-plato-ordenar">
                                <img src="{{asset('public'.$plato->imagen)}}" class="w-100">
                            </label>
                        </span>
                        @endforeach
                        <input type="hidden" value="[]" name="valueImgOrden" class="valueImgOrden">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" method="POST" action="{{ route('categorias.editarCategorias', ['restauranteId'=>$restaurante->id])}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCategoriaModalLabel">Editar categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="" class="col-form-label">Categorías:</label>
                            @foreach($restaurante->categorias as $categoria)
                                <input type="text" class="form-control mb-2 categoriasEdit" value="{{$categoria}}" placeholder="{{$categoria}}">
                            @endforeach
                        </div>
                        <input type="hidden" name="categorias" class="categoriasJson">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary editarCategoria">Editar categorías</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <h3>Categorias:</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            {{-- START-PESTAÑAS --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($restaurante->categorias as $categoria)
                    @if($loop->index==0)
                        <li class="nav-item">
                            <a class="nav-link active categoria-link" id="categoria-tab" data-toggle="tab" href="#categoria{{$loop->index}}" role="tab" aria-controls="categoria{{$loop->index}}" aria-selected="true">{{$categoria}}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link categoria-link" id="categoria-tab" data-toggle="tab" href="#categoria{{$loop->index}}" role="tab" aria-controls="categoria{{$loop->index}}" aria-selected="false">{{$categoria}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            {{-- END-PESTAÑAS --}}

            {{-- START CONTENIDO DE LAS PESTAÑAS --}}
            <?php $iCategoria=0; ?>
            <div class="tab-content" id="myTabContent">
                <form method="POST" action="{{ route('categorias.organizarPlatos',['restauranteId'=>$restaurante->id]) }}">
                    @csrf
                    <input type="hidden" name="posiciones" class="posiciones" value="[]">
                    <input class="btn btn-success d-none guardarCambios float-right m-2" type="submit" value="Guardar cambios">
                </form>
                @foreach($restaurante->categorias as $categoria)
                {{-- START CATEGORIA --}}
                <div class="tab-pane fade @if($loop->index==0){{'show active'}}@endif" id="categoria{{$loop->index}}" role="tabpanel" aria-labelledby="categoria{{$loop->index}}-tab">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between" style="flex-wrap: wrap;">
                            <a  class="my-2 btn-guardar btn" data-toggle="collapse" href="#idp{{$loop->index}}" role="button" aria-expanded="false" aria-controls="idp{{$loop->index}}">Agregar plato</a>
                            <button class="my-2 btn-secondary btn" data-toggle="modal" data-target="#editarCategoriaModal" >
                                Editar categoría
                            </button>
                        </div>
                        <div class="collapse multi-collapse p-0 float-right" id="idp{{$loop->index}}">
                            <div class="card card-body p-1">
                            <div class="row">
                                <div class="col-12 col-sm-10 col-lg-8 col-xl-6 text-center">
                                    <div class="card">
                                        <form method="POST" action="{{ route('categorias.agregarProducto') }}" enctype="multipart/form-data" class="formPlato">
                                            @csrf
                                            <div class="card-header">AGREGAR NUEVO PRODUCTO:</div>
                                            <div class="card-body">
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="nombre">Nombre</span>
                                                    </div>
                                                    <input type="text" required name="nombre" class="form-control" aria-label="nombre" aria-describedby="nombre">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Descripción:</label>
                                                    <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>

        
                                               
                                                <div id="formulario{{$categoria}}" class="formulario">
                                                    <label for="Presentacion">Presentaciones</label>
                                                    <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
                                                    <div class="input-group" name="presentacion-0">
                                                        <select name="nombres[]" class="form-control col-md-6">
                                                            <option value="Tapa">Tapa</option>
                                                            <option value="1/2 Ración">1/2 Ración</option>
                                                            <option value="Ración">Ración</option>
                                                             <option value="Plato">Plato</option>
                                                             <option value="Kilogramo">Kilogramo</option>

                                                        </select>
                                                        <input type="number" class="form-control col-md-6 @error('Cantidad') is-invalid @enderror" name="precios[]" placeholder="Precio" required>
                                                    </div>
                                                 </div>






                                                <div class="input-group mb-3">
                                                    {{-- para recortar --}}
                                                    <label for="original_image" class="btn btn-success" {{"onclick=pestanaActiva($iCategoria)"}}>
                                                        Agregar imagen +
                                                    </label>
                                                    <input id="original_image" style="display:none;" type="file" name="imagen"  class="form-control">
                                                    {{-- recortado (oculto) --}}
                                                    <input id="imagen1" type="text" name="file" class="form-control d-none imagenClass">
                                                    <img class="imagen_final" id="imagen_final" src="" alt="">
                                                </div>

                                                <div class="form-group cont-alergenos-crear">
                                                    <?php
                                                        $cantAlergenos=16;
                                                        $nombreAlergenos=[
                                                            'Gluten','Crustáceos','Huevos','Pescado',
                                                            'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
                                                            'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
                                                            'Moluscos','Altramuces'
                                                        ];
                                                    ?>
                                                    @for($i = 1; $i <=$cantAlergenos; $i++)
                                                        <span>
                                                            <input type="checkbox" id="alergeno{{$i.$categoria}}" class="checkAlergeno" data-id="{{'pos'.$iCategoria}}">
                                                            <label for="alergeno{{$i.$categoria}}">
                                                                <img src="{{asset('public/images/alergenos/'.$i.'.png')}}" alt="">
                                                                @if($i!==15 && $i!==16)<p>{{$nombreAlergenos[$i-1]}}</p>@endif
                                                            </label>
                                                        </span>
                                                    @endfor
                                                    <input type="hidden" value="[]" class="numAlergenos" name="alergenos" />
                                                </div>
                                                <div class="input-group mb-3 d-flex justify-content-center">
                                                    <input class="btn btn-primary btn-sm" type="submit" value="Registrar Producto">
                                                </div>
                                            </div>
                                            <input type="hidden" name="restauranteId" value="{{$restaurante->id}}">
                                            <input type="hidden" name="categoria" value="{{$categoria}}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-3">
                        <div class="row drag-sort-enable">
                            @foreach($platos as $plato)
                                @if($plato->categoria==$categoria)
                                    <div class="col-12 col-sm-6 col-md-4 my-3 d-flex agarrar" data-pos="{{$plato->pos}}">
                                        <div class="card">
                                            <div class="btn-group dropright">
                                                <button type="button" class="btn btn-secondary dropdown-toggle opc-plato" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{asset('public/images/menu.svg')}}" alt="">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <h6 class="dropdown-header">Mover a</h6>
                                                    @foreach($restaurante->categorias as $categoriaa)
                                                        @if($categoriaa==$categoria)
                                                        @else
                                                            <form method="POST" action="{{ route('categorias.cambiarCategoria', ['id' => $plato->id, 'categoria' => $categoriaa, 'restauranteId' => $restaurante->id]) }}">
                                                                @csrf
                                                                <input type="submit" class="dropdown-item" value="{{$categoriaa}}" />
                                                            </form>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <img class="card-img-top" src="{{asset('public'.$plato->imagen)}}" alt="Imagen de ejemplo">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $plato->nombre }}</h5>
                                                <p class="card-text">{{ $plato->precios }}€</p>
                                                <a onclick=cambiarStatus("{{url('/categoria/cambiarstatus',['id'=>$plato->id])}}",{{$plato->id}}) href="#">
                                                    <p class="p{{$plato->id}} card-text @if($plato->status=='1') {{'text-success'}} @else {{'text-danger'}} @endif">@if($plato->status=='1') {{'Habilitado'}} @else {{'Inhabilitado'}} @endif</p>
                                                </a>

                                                <a  class="mt-2" data-toggle="collapse" href="#id{{$plato->id}}" role="button" aria-expanded="false" aria-controls="id{{$plato->id}}">Ver desripción</a>
                                                <div class="collapse multi-collapse p-0" id="id{{$plato->id}}">
                                                    <div class="card card-body p-1">
                                                        {{$plato->descripcion}}
                                                    </div>
                                                </div>

                                                <div class="cont-alergenos">
                                                    <?php

                                                        $alergenos=json_decode($plato->alergenos);
                                                        $nombreAlergenos=[
                                                            'Gluten','Crustáceos','Huevos','Pescado',
                                                            'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
                                                            'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
                                                            'Moluscos','Altramuces'
                                                        ];
                                                    ?>
                                                    @foreach($alergenos as $alergeno)
                                                        <span>
                                                            <img src="{{asset('public/images/alergenos/'.$alergeno.'.png')}}" alt="">
                                                            @if($alergeno!==15 && $alergeno!==16)<p>{{$nombreAlergenos[$alergeno-1]}}</p>@endif
                                                        </span>
                                                    @endforeach
                                                </div>

                                                <div class="d-flex justify-content-end align-items-center">
                                                    <a @click="handleEdicionDeProductoEnCategoria({{$plato->id}}, '{{$plato->nombre}}', '{{asset('public'.$plato->imagen)}}', {{json_encode($plato->descripcion)}}, {{$plato->alergenos}},'{{$plato->precios}}','{{$plato->presentacion}}' )" href="#" class="btn btn-opc btn-sm mr-2">
                                                        <i class="icon_pencil-edit edit-orden "></i>
                                                        Editar
                                                    </a>

                                                    <form method="POST" action="{{ route('categorias.eliminarProducto',['id'=>$plato->id,'restauranteId'=>$restaurante->id]) }}" enctype="multipart/form-data">
                                                        @method("delete")
                                                        @csrf
                                                        <button type="submit" class="btn btn-opc btn-sm">
                                                            <i class="fa fa-trash-o " aria-hidden="true"></i>
                                                            Borrar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>{{-- END ENTRANTES --}}
                <?php $iCategoria++; ?>
                @endforeach

            </div>{{-- END CONTENIDO DE LAS PESTAÑAS --}}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ventanaModal" tabindex="-1" style="z-index:9999 !important;overflow-y: scroll;" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seleccione el área de la imágen final (800 x 800)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8">
                <img class="imagen_en_categoria" id="imagen_original_visualizada" src="" alt="">
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

<!-- Modal de edición -->
<div class="modal fade" id="modal_de_edicion"  style="overflow-y: scroll;" tabindex="-1" aria-labelledby="modal_de_edicion1" aria-hidden="true">
    <form method="POST" action="{{ route('categorias.editarProducto') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_de_edicion1">Modo Edición</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="nombre">Nombre:</label>
                            <input type="text" v-model="editando.nombre" class="form-control" name="nombre">


                            
                            <div id="formulario" class="formulario">
                                <label for="Presentacion">Presentaciones</label>
                                <button type="button" class="clonaredit btn btn-secondary btn-sm">+</button>
                                <div class="input-group-edit" name="presentacion-0" v-for="(presentacion,index) in editando.presentaciones">
                                    <select name="nombres[]" class="form-control col-md-6">
                                        <option v-model="presentacion.nombre" >@{{ presentacion.nombre }}</option>
                                    <option value="Tapa">Tapa</option>
                                                            <option value="1/2 Ración">1/2 Ración</option>
                                                            <option value="Ración">Ración</option>
                                                             <option value="Plato">Plato</option>
                                                             <option value="Kilogramo">Kilogramo</option>
                                    </select>
                                    <input type="number" class="form-control col-md-6" name="precios[]" placeholder="Precio" v-model="presentacion.precio" step=".01" required><h5>€</h5>
                                    <a v-show="index > 0" ef="#" class="remover_campo">Remover</a>
                                </div>
                            </div>

                            
                            
                            
                            
                            <label for="descripcion">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control w-100" rows="5" v-model="editando.descripcion"></textarea>

                            <?php
                                $cantAlergenos=16;
                                $nombreAlergenos=[
                                    'Gluten','Crustáceos','Huevos','Pescado',
                                    'Cacahuetes','Soja','Lácteos','Frutos de cáscara','Apio',
                                    'Mostaza','Granos de sésamo','Dióxido de azufre y sulfitos',
                                    'Moluscos','Altramuces'
                                ];

                            ?>
                            <span class="cont-alergenos-edit">
                                @for($i = 1; $i <=$cantAlergenos; $i++)
                                    <span>
                                        <input type="checkbox" id="alergeno{{$i}}" class="checkAlergenosEdit" data-id="{{'pos'}}">
                                        <label for="alergeno{{$i}}">
                                            <img src="{{asset('public/images/alergenos/'.$i.'.png')}}" class="img-alergenos-edit" alt="">
                                            @if($i!==15 && $i!==16)<p>{{$nombreAlergenos[$i-1]}}</p>@endif
                                        </label>
                                    </span>
                                @endfor
                            </span>
                                <input type="hidden" :value=`${JSON.stringify(editando.alergenos)}` class="numAlergenosEdit" name="alergenos" />

                            <div class="input-group my-3">
                                {{-- para recortar --}}
                                <label for="original_image" class="btn btn-success" onclick="pestanaActiva(999)">
                                    Cambiar imagen +
                                </label>
                                <input id="original_image" style="display:none;" type="file" name="imagen"  class="form-control">
                            </div>
                            {{-- recortado (oculto) --}}
                            <input id="imagen1" type="text" name="file" class="form-control d-none imagenClass">
                            <img class="imagen_final" id="imagen_final" :src="editando.rutaImg" alt="">
                        </div>

                        <input type="hidden" name="id" :value="editando.id" />
                        <input type="hidden" name="restauranteId" value="{{$restaurante->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="cerrarModalDeEdicion" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal de edición -->

@endsection

@section('scripts')
<!-- Cropper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js" integrity="sha512-1bpfZkKJ+WlmJN/I2KLm79dSiuOos0ymwL5IovsUVARyzcaf9rSXsVO2Cdg4qlKNOQXh8fd1d0vKeY9Ru3bQDw==" crossorigin="anonymous"></script>

<script>
    const app = new Vue({
        el: '#app',
        data: {
        editando: {
            id: null,
            nombre: null,
            precio: null,
            descripcion: null,
            rutaImg: null,
            alergenos: [],
            presentaciones:[],
        }
    },
    methods: {
        handleEdicionDeProductoEnCategoria(id,nombre,rutaImg, descripcion, alergenos, precios, presentacion){
            
               var str=precios;
                    var str2=presentacion;
                    const arreglo2=str2.split(",");
                    const arreglo = str.split(",");
                  this.flag=arreglo.length;
                //    console.log(this.flag);
                    var presentaciones = [];
                   
                     /////HACER UN FOR QUE CUENTE CUNTAS PRESENTACIONES HAY Y CREE UN ARRAY DE OBJETOS, Y UNA VARIABLE CANTIDAD PARA CAD UNA  LUEGO CUANDO 
                    for (var i=0; i<this.flag; i++){
                        let aux = {
                            "nombre": arreglo2[i],
                            "precio": parseInt(arreglo[i]),
                            "cantidad":1,
                            "index":i,
                            "precioCantidad":arreglo[i]
                        }
                        presentaciones.push(aux);
                    }
            this.editando.presentaciones=presentaciones;
            this.editando.id = id;
            this.editando.nombre = nombre;
           // this.editando.precio = precio;
            this.editando.rutaImg = rutaImg;
            this.editando.descripcion = descripcion;
            this.editando.alergenos = alergenos;

            const arr=alergenos;
            let arrAlergenos=[];

            document.querySelectorAll("#modal_de_edicion .checkAlergenosEdit").forEach(input=>{
                input.checked=false;
            });

            arr.forEach(ele=>{
                arrAlergenos.push(ele);
                document.querySelector("#alergeno"+ele).checked=true;
            });

            asignarValue(arrAlergenos);


            $('#modal_de_edicion').modal('show');
        },

        cerrarModalDeEdicion(){
            $('#modal_de_edicion').modal('hide');
        }
    }
    });
</script>
<script>
    var campos_max = 2; 
    var maximo=3;
    var x = 0;
    
    
        $('.clonar').click(function() {
            var idFormulario = $(this).parent('div').attr('id');
        // Clona el .input-group
        if (x < campos_max) {
          //var $clone = $('#formularioTapas .input-group').last().clone();
         var $clone = $('#'+idFormulario+' .input-group').last().clone();
          
            // Borra los valores de los inputs clonados
            $clone.find(':input').each(function () {
                if ($(this).is('select')) {
                this.selectedIndex = 0;
                } else {
         this.value = '';
                }
            });

            // Agrega lo clonado al final del #formulario
            x++;

            $clone.append('<a href="#" class="remover_campo">Remover</a>');
            $clone.appendTo('#'+idFormulario).attr("name","presentacion-"+(x));;

            
        }
    });

    $('#formulario').on("click",".remover_campo",function(e) {
        
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
        });
        
              $('.clonaredit').click(function() {
                  var y = $(".input-group-edit").toArray().length;
                 
            var idFormulario = $(this).parent('div').attr('id');
        // Clona el .input-group
        if (y < maximo) {

         var $clone = $('#'+idFormulario+' .input-group-edit').first().clone();
          
            // Borra los valores de los inputs clonados
            $clone.find(':input').each(function () {
                if ($(this).is('select')) {
                this.selectedIndex = 0;
                } else {
         this.value = '';
                }
            });

            // Agrega lo clonado al final del #formulario
            x++;
            $clone.append('<a href="#" class="remover_campo">Remover</a>');
            $clone.appendTo('#'+idFormulario).attr("name","presentacion-"+(x));;

            
        }
    });
</script>

<script src="{{asset('public/js/categorias.js')}}"></script>
<script src="{{asset('public/js/dragSort.js')}}"></script>

@endsection

