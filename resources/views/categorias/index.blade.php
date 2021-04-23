@extends('categorias.layout')

@section('categoria-content')
    <div class="container mt-4">
       <div class="row justify-content-center">
          <h3>Restaurante:</h3>
       </div>
       <div class="row mt-2">
          <div class="col">
            <div class="form-row">
               <div class="form-group col-md-4">
                 <label for="nombre">Nombre</label>
               <input disabled name="nombre" type="text" :value="restaurante.nombre" class="form-control">
               </div>
               <div class="form-group col-md-4">
                  <label for="direccion">Dirección</label>
                  <input disabled name="direccion" type="text" class="form-control" :value="restaurante.direccion">
               </div>
               <div class="form-group col-md-4">

                  <label for="telefono">Teléfono</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">+34</div>
                    </div>
                    <input disabled :value="restaurante.telefono" name="telefono" type="text" class="form-control" id="telefono">
                  </div>

               </div>
            </div>
          </div>
       </div>

       <div class="row">
          <div class="col text-right">
             <a href="{{ url('/') }}">
                <button class="btn btn-info btn-sm">Página de inicio</button>
             </a>
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
                <li class="nav-item">
                  <a class="nav-link active" id="entrantes-tab" data-toggle="tab" href="#entrantes" role="tab" aria-controls="entrantes" aria-selected="true">Entrantes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="sopas-tab" data-toggle="tab" href="#sopas" role="tab" aria-controls="sopas" aria-selected="false">Sopas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="fritos-tab" data-toggle="tab" href="#fritos" role="tab" aria-controls="fritos" aria-selected="false">Fritos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="carnes-tab" data-toggle="tab" href="#carnes" role="tab" aria-controls="carnes" aria-selected="false">carnes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pescado-tab" data-toggle="tab" href="#pescado" role="tab" aria-controls="pescado" aria-selected="false">pescado</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pastas-tab" data-toggle="tab" href="#pastas" role="tab" aria-controls="pastas" aria-selected="false">pastas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="postres-tab" data-toggle="tab" href="#postres" role="tab" aria-controls="postres" aria-selected="false">postres</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="bebidas-tab" data-toggle="tab" href="#bebidas" role="tab" aria-controls="bebidas" aria-selected="false">bebidas</a>
                </li>
              </ul>{{-- END-PESTAÑAS --}}
              {{-- START CONTENIDO DE LAS PESTAÑAS --}}
              <div class="tab-content" id="myTabContent">
                 {{-- START ENTRANTES --}}
                <div class="tab-pane fade show active" id="entrantes" role="tabpanel" aria-labelledby="entrantes-tab">
                   <div class="container-fluid mt-3">
                      <div class="row">

                         <div v-for="(producto, index) in categorias.entrantes" :key="producto.id" class="col-md-3 d-flex">
                           <div  class="card" style="width: 18rem;">
                              <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                              <div class="card-body">
                                 <h5 class="card-title">@{{ producto.nombre }}</h5>
                                 <p class="card-text">@{{ producto.precio }}€</p>
                                 <a @click.prevent="cambiarStatus(producto.id, 'entrantes')" href="#">
                                    <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                                 </a>
                                 <div class="d-flex justify-content-end align-items-center">
                                    <a @click="handleEdicionDeProductoEnCategoria(producto, 'entrantes')" href="#" class="btn btn-info btn-sm">Editar</a>
                                    <a @click="eliminarEntrante(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                                 </div>
                              </div>
                           </div>
                         </div>


                      </div>

                      <div class="row">
                        <div v-if="!addNewCardEntrante" class="col text-center">
                           <div @click="addNewCardEntrante = !addNewCardEntrante" class="card" style="width: 18rem;">
                              <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                           </div>
                        </div>
                        <div v-else="addNewCardEntrante" class="col text-center">
                           <div class="card" style="width: 18rem;">
                              <div class="card-header">AGREGAR NUEVO PRODUCTO (Entrante):</div>
                              <div class="card-body">

                                 <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="nombre">Nombre</span>
                                    </div>
                                    <input v-model="newEntranteNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                 </div>
                                 <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="precio">Precio</span>
                                    </div>
                                    <input v-model="newEntrantePrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                 </div>

                                 <div class="input-group mb-3">

                                    <input @change="onImageBase64Change($event, 'newEntranteImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                    {{-- <input @change="onImageFileChangeEntrante" type="file" name="files[]" id="file-selector" class="form-control d-none"/> --}}
                                 </div>
                                 <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newEntranteImageFile" src="" alt="">
                                 </div>
                                 <div class="input-group mb-3 d-flex justify-content-center">
                                    <input @click="AddNewProductoEntrante" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                 </div>




                              </div>
                           </div>
                        </div>
                      </div>
                   </div>
                </div>{{-- END ENTRANTES --}}
                {{-- START SOPAS --}}
                <div class="tab-pane fade" id="sopas" role="tabpanel" aria-labelledby="sopas-tab">


                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.sopas" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'sopas')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'sopas')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarSopa(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardSopa" class="col text-center">
                          <div @click="addNewCardSopa = !addNewCardSopa" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardSopa" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Sopa):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newSopaNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newSopaPrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                   <input @change="onImageBase64Change($event, 'newSopaImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangeSopa" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newSopaImageFile" src="" alt="">
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoSopa" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>



               </div>{{-- END SOPAS --}}
                {{-- START fritos --}}
                <div class="tab-pane fade" id="fritos" role="tabpanel" aria-labelledby="fritos-tab">


                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.fritos" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'fritos')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'fritos')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarFrito(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardFrito" class="col text-center">
                          <div @click="addNewCardFrito = !addNewCardFrito" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardFrito" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Frito):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newFritoNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newFritoPrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                    <input @change="onImageBase64Change($event, 'newFritoImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangeFrito" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newFritoImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoFrito" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>


               </div>{{-- END fritos --}}
               {{-- START carnes --}}
                <div class="tab-pane fade" id="carnes" role="tabpanel" aria-labelledby="carnes-tab">


                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.carnes" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'carnes')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'carnes')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarCarne(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardCarne" class="col text-center">
                          <div @click="addNewCardCarne = !addNewCardCarne" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardCarne" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Carne):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newCarneNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newCarnePrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                    <input @change="onImageBase64Change($event, 'newCarneImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangeCarne" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newCarneImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoCarne" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>



               </div>{{-- END carnes --}}
               {{-- START pescado --}}
                <div class="tab-pane fade" id="pescado" role="tabpanel" aria-labelledby="pescado-tab">


                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.pescados" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'pescados')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'pescados')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarPescado(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardPescado" class="col text-center">
                          <div @click="addNewCardPescado = !addNewCardPescado" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardPescado" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Pescado):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newPescadoNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newPescadoPrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                  <input @change="onImageBase64Change($event, 'newPescadoImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangePescado" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newPescadoImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoPescado" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>



               </div>{{-- END pescado --}}
               {{-- START pastas --}}
                <div class="tab-pane fade" id="pastas" role="tabpanel" aria-labelledby="pastas-tab">



                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.pastas" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'pastas')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'pastas')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarPasta(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardPasta" class="col text-center">
                          <div @click="addNewCardPasta = !addNewCardPasta" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardPasta" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Pasta):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newPastaNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newPastaPrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                 <input @change="onImageBase64Change($event, 'newPastaImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangePasta" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newPastaImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoPasta" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>




               </div>{{-- END pastas --}}
               {{-- START postres --}}
                <div class="tab-pane fade" id="postres" role="tabpanel" aria-labelledby="postres-tab">



                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.postres" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'postres')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'postres')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarPostre(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardPostre" class="col text-center">
                          <div @click="addNewCardPostre = !addNewCardPostre" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardPostre" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Postre):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newPostreNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newPostrePrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                  <input @change="onImageBase64Change($event, 'newPostreImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangePostre" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newPostreImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoPostre" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>



               </div>{{-- END postres --}}
               {{-- START bebidas --}}
                <div class="tab-pane fade" id="bebidas" role="tabpanel" aria-labelledby="bebidas-tab">


                  <div class="container-fluid mt-3">
                     <div class="row">

                        <div v-for="(producto, index) in categorias.bebidas" :key="producto.id" class="col-md-3 d-flex">
                          <div  class="card" style="width: 18rem;">
                             <img class="card-img-top" :src="imageWithUrl(producto.imagen)" alt="Imagen de ejemplo">
                             <div class="card-body">
                                <h5 class="card-title">@{{ producto.nombre }}</h5>
                                <p class="card-text">@{{ producto.precio }}€</p>
                                <a @click.prevent="cambiarStatus(producto.id, 'bebidas')" href="#">
                                 <p class="card-text" :class="producto.status == '1' ? 'text-success' : 'text-danger' ">@{{ producto.status == "1" ? "Habilitado" : "Inhabilitado" }}</p>
                              </a>
                                 <a @click="handleEdicionDeProductoEnCategoria(producto, 'bebidas')" href="#" class="btn btn-info btn-sm">Editar</a>
                                 <a @click="eliminarBebida(producto.id)" href="#" class="btn btn-danger btn-sm">Borrar</a>
                             </div>
                          </div>
                        </div>


                     </div>

                     <div class="row">
                       <div v-if="!addNewCardBebida" class="col text-center">
                          <div @click="addNewCardBebida = !addNewCardBebida" class="card" style="width: 18rem;">
                             <i class="fas fa-plus-circle" style="font-size: 10vw"></i>
                          </div>
                       </div>
                       <div v-else="addNewCardBebida" class="col text-center">
                          <div class="card" style="width: 18rem;">
                             <div class="card-header">AGREGAR NUEVO PRODUCTO (Bebida):</div>
                             <div class="card-body">

                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="nombre">Nombre</span>
                                   </div>
                                   <input v-model="newBebidaNombre" type="text" class="form-control" aria-label="nombre" aria-describedby="nombre">

                                </div>
                                <div class="input-group input-group-sm mb-3">
                                   <div class="input-group-prepend">
                                   <span class="input-group-text" id="precio">Precio</span>
                                   </div>
                                   <input v-model="newBebidaPrecio" type="number" class="form-control" aria-label="precio" aria-describedby="precio">
                                </div>

                                <div class="input-group mb-3">

                                   <input @change="onImageBase64Change($event, 'newBebidaImageFile')" type="file" name="imagen" id="original_image" class="form-control"/>

                                   {{-- <input @change="onImageChangeBebida" type="file" name="files[]" id="file-selector" class="form-control"/> --}}
                                </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <img class="imagen_en_categoria" id="imagen_final_newBebidaImageFile" src="" alt="">
                                 </div>
                                <div class="input-group mb-3 d-flex justify-content-center">
                                   <input @click="AddNewProductoBebida" class="btn btn-success btn-sm" type="submit" value="Registrar Producto">
                                </div>



                             </div>
                          </div>
                       </div>
                     </div>
                  </div>


               </div>{{-- END bebidas --}}

              </div>{{-- END CONTENIDO DE LAS PESTAÑAS --}}
          </div>
       </div>
    </div>

       <!-- Modal -->
       <div class="modal fade" id="ventanaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Seleccione el área de la imágen final (800 x 800)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-8">
                        <img class="imagen_en_categoria" id="imagen_original_izquierda" src="" alt="">
                     </div>
                     <div class="col-md-4 d-flex justify-content-center">
                        <div class="preview_imagen_recortada"></div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button @click="recortarImagen" id="crop" type="button" class="btn btn-primary">Recortar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->

       <!-- Modal de edición -->
       <div class="modal fade" id="modal_de_edicion" tabindex="-1" aria-labelledby="modal_de_edicion" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modal_de_edicion">Modo Edición</h5>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <label for="nombre">Nombre:</label>
                        <input type="text" v-model="editando.nombre" class="form-control">

                        <label for="nombre">Precio:</label>
                        <input type="number" v-model="editando.precio" class="form-control" min="0">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button @click="cerrarModalDeEdicion" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button @click="editarProductoDeCategoria()" type="button" class="btn btn-success">Guardar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal de edición -->

@endsection

@section('customJS')
   <script>

      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const restaurante = {!! json_decode($restaurante) !!};
      const entrantes = {!! json_decode($entrantes) !!};
      const sopas = {!! json_decode($sopas) !!};
      const fritos = {!! json_decode($fritos) !!};
      const carnes = {!! json_decode($carnes) !!};
      const pescados = {!! json_decode($pescados) !!};
      const pastas = {!! json_decode($pastas) !!};
      const postres = {!! json_decode($postres) !!};
      const bebidas = {!! json_decode($bebidas) !!};
      let CROPPER;

      const urlAddNewProductoEntrante = "{{ route('categorias.AddNewProductoEntrante') }}";
      const url_home = "{{ url('') }}";

      const app = new Vue({
         el: '#app',
         data: {
            restaurante:  restaurante,
            categorias: {
               entrantes: entrantes,
               sopas: sopas,
               fritos: fritos,
               carnes: carnes,
               pescados: pescados,
               pastas: pastas,
               postres: postres,
               bebidas: bebidas
            },
            addNewCardEntrante: false,
            newEntranteImageFile: null,
            newEntranteNombre: '',
            newEntrantePrecio: null,

            addNewCardSopa: false,
            newSopaImageFile: {},
            newSopaNombre: '',
            newSopaPrecio: null,

            addNewCardFrito: false,
            newFritoImageFile: {},
            newFritoNombre: '',
            newFritoPrecio: null,

            addNewCardCarne: false,
            newCarneImageFile: {},
            newCarneNombre: '',
            newCarnePrecio: null,

            addNewCardPescado: false,
            newPescadoImageFile: {},
            newPescadoNombre: '',
            newPescadoPrecio: null,

            addNewCardPasta: false,
            newPastaImageFile: {},
            newPastaNombre: '',
            newPastaPrecio: null,

            addNewCardPostre: false,
            newPostreImageFile: {},
            newPostreNombre: '',
            newPostrePrecio: null,

            addNewCardBebida: false,
            newBebidaImageFile: {},
            newBebidaNombre: '',
            newBebidaPrecio: null,

            url: url_home,

            fileUploaded: null,
            categoria_que_esta_mostrando_la_ventana_modal: null,

            editando: {
               id: null,
               nombre: null,
               precio: null,
               imagen: null,
               nombre_de_la_tabla_db: null,
            }

         },
         methods: {
            onImageFileChangeEntrante(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newEntranteImageFile = files[0];

            },
            onImageBase64Change(e, nombre_de_la_categoria_actual){
               let files = e.target.files;
               if (files && files.length > 0) {
                  this.fileUploaded = files[0];
                  let reader = new FileReader();
                  reader.onload = function(e){
                     app.showImageInModal(reader.result, 'imagen_original_izquierda', '#ventanaModal');
                     app.categoria_que_esta_mostrando_la_ventana_modal = nombre_de_la_categoria_actual;
                  };
                  reader.readAsDataURL(this.fileUploaded);

               }
            },
            recortarImagen(){
               canvas = CROPPER.getCroppedCanvas({
                  width: 800,
                  height: 800
               })

               canvas.toBlob(function(blob) {
                  url = URL.createObjectURL(blob);
                  let reader = new FileReader();
                  reader.readAsDataURL(blob);
                  reader.onloadend = function() {
                     let base64data = reader.result;
                     app[app.categoria_que_esta_mostrando_la_ventana_modal] = base64data;
                     document.getElementById(`imagen_final_${app.categoria_que_esta_mostrando_la_ventana_modal}`).src = base64data;
                     $('#ventanaModal').modal('hide');
                  };
               })
            },

            onImageChangeSopa(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newSopaImageFile = files[0];

            },
            onImageChangeFrito(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newFritoImageFile = files[0];

            },
            onImageChangeCarne(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newCarneImageFile = files[0];

            },
            onImageChangePescado(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newPescadoImageFile = files[0];

            },
            onImageChangePasta(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newPastaImageFile = files[0];

            },
            onImageChangePostre(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newPostreImageFile = files[0];

            },
            onImageChangeBebida(e) {
               let files = e.target.files || e.dataTransfer.files;
               if (!files.length)
               return;
               this.newBebidaImageFile = files[0];

            },
            // START ENTRANTES
            AddNewProductoEntrante: function(){
               if (this.newEntranteImageFile === null || this.newEntranteNombre === '' || this.newEntrantePrecio === null) {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newEntranteNombre);
               form.append('precio', parseFloat(app.newEntrantePrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newEntranteImageFile);

               fetch("{{ url('/categoria/AddNewProductoEntrante') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoEntrante(data);
                 });

               this.newEntranteNombre = '';
               this.newEntrantePrecio = null;
               this.newEntranteImageFile = '';
               this.addNewCardEntrante = false;
            },

            showNewProductoEntrante: function(producto){
               this.categorias.entrantes.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarEntrante: function(id){
               // eliminar en interfaz:
               this.categorias.entrantes = this.categorias.entrantes.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarEntrante') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },

            handleEdicionDeProductoEnCategoria(producto, nombre_de_la_tabla_db){
               this.editando.id = producto.id;
               this.editando.nombre = producto.nombre;
               this.editando.precio = producto.precio;
               this.editando.nombre_de_la_tabla_db = nombre_de_la_tabla_db;
               $('#modal_de_edicion').modal('show');
            },

            editarProductoDeCategoria(){
               axios.post( "{{route('categorias.editarEntrante')}}", {'producto': this.editando})
                  .then(res => {
                     this.categorias[res.data.nombre_de_la_tabla_db].map(producto => {
                        if (res.data.id === producto.id) {
                           producto.nombre = res.data.nombre;
                           producto.precio = res.data.precio;
                        }
                     })
                  })
                  .catch(err => {console.log(err)})
               $('#modal_de_edicion').modal('hide');
               this.editando.id = null;
               this.editando.nombre = null;
               this.editando.precio = null;
               this.editando.nombre_de_la_tabla_db = null;
            },

            cerrarModalDeEdicion(){
               $('#modal_de_edicion').modal('hide');
            },

            cambiarStatus: function(id, nombre){
               for (let i = 0; i < this.categorias[`${nombre}`].length; i++) {
                  if (this.categorias[`${nombre}`][i].id === id) {
                     this.categorias[`${nombre}`][i].status = ( this.categorias[`${nombre}`][i].status === "1" ) ? "2" : "1";
                  }
               }

               fetch(`{{ url('/categoria/cambiarstatus') }}/${id}/${nombre}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END ENTRANTES
            // START SOPA
            AddNewProductoSopa: function(){
               if (this.newSopaImageFile === {} || this.newSopaNombre === '' || this.newSopaPrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newSopaNombre);
               form.append('precio', parseFloat(app.newSopaPrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newSopaImageFile);

               fetch("{{ url('/categoria/AddNewProductoSopa') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoSopa(data);
                 });

               this.newSopaNombre = '';
               this.newSopaPrecio = null;
               this.newSopaImageFile = '';
               this.addNewCardSopa = false;
            },

            showNewProductoSopa: function(producto){
               this.categorias.sopas.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarSopa: function(id){
               // eliminar en interfaz:
               this.categorias.sopas = this.categorias.sopas.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarSopa') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END SOPA
            // START FRITOS
            AddNewProductoFrito: function(){
               if (this.newFritoImageFile === {} || this.newFritoNombre === '' || this.newFritoPrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newFritoNombre);
               form.append('precio', parseFloat(app.newFritoPrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newFritoImageFile);

               fetch("{{ url('categoria/AddNewProductoFrito') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoFrito(data);
                 });

               this.newFritoNombre = '';
               this.newFritoPrecio = null;
               this.newFritoImageFile = '';
               this.addNewCardFrito = false;
            },

            showNewProductoFrito: function(producto){
               this.categorias.fritos.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarFrito: function(id){
               // eliminar en interfaz:
               this.categorias.fritos = this.categorias.fritos.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarFrito') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END FRITOS
            // START CARNES
            AddNewProductoCarne: function(){
               if (this.newCarneImageFile === {} || this.newCarneNombre === '' || this.newCarnePrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newCarneNombre);
               form.append('precio', parseFloat(app.newCarnePrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newCarneImageFile);

               fetch("{{ url('categoria/AddNewProductoCarne') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoCarne(data);
                 });

               this.newCarneNombre = '';
               this.newCarnePrecio = null;
               this.newCarneImageFile = '';
               this.addNewCardCarne = false;
            },

            showNewProductoCarne: function(producto){
               this.categorias.carnes.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarCarne: function(id){
               // eliminar en interfaz:
               this.categorias.carnes = this.categorias.carnes.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarCarne') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END CARNES
            // START PESCADOS
            AddNewProductoPescado: function(){
               if (this.newPescadoImageFile === {} || this.newPescadoNombre === '' || this.newPescadoPrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newPescadoNombre);
               form.append('precio', parseFloat(app.newPescadoPrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newPescadoImageFile);

               fetch("{{ url('/categoria/AddNewProductoPescado') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoPescado(data);
                 });

               this.newPescadoNombre = '';
               this.newPescadoPrecio = null;
               this.newPescadoImageFile = '';
               this.addNewCardPescado = false;
            },

            showNewProductoPescado: function(producto){
               this.categorias.pescados.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarPescado: function(id){
               // eliminar en interfaz:
               this.categorias.pescados = this.categorias.pescados.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarPescado') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END PESCADOS
            // START PASTAS
            AddNewProductoPasta: function(){
               if (this.newPastaImageFile === {} || this.newPastaNombre === '' || this.newPastaPrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newPastaNombre);
               form.append('precio', parseFloat(app.newPastaPrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newPastaImageFile);

               fetch("{{ url('/categoria/AddNewProductoPasta') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoPasta(data);
                 });

               this.newPastaNombre = '';
               this.newPastaPrecio = null;
               this.newPastaImageFile = '';
               this.addNewCardPasta = false;
            },

            showNewProductoPasta: function(producto){
               this.categorias.pastas.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarPasta: function(id){
               // eliminar en interfaz:
               this.categorias.pastas = this.categorias.pastas.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarPasta') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END PASTAS
            // START POSTRES
            AddNewProductoPostre: function(){
               if (this.newPostreImageFile === {} || this.newPostreNombre === '' || this.newPostrePrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newPostreNombre);
               form.append('precio', parseFloat(app.newPostrePrecio).toFixed(2) );
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newPostreImageFile);

               fetch("{{ url('categoria/AddNewProductoPostre') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoPostre(data);
                 });

               this.newPostreNombre = '';
               this.newPostrePrecio = null;
               this.newPostreImageFile = '';
               this.addNewCardPostre = false;
            },

            showNewProductoPostre: function(producto){
               this.categorias.postres.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarPostre: function(id){
               // eliminar en interfaz:
               this.categorias.postres = this.categorias.postres.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarPostre') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END POSTRES
            // START BEBIDAS
            AddNewProductoBebida: function(){
               if (this.newBebidaImageFile === {} || this.newBebidaNombre === '' || this.newBebidaPrecio === '') {
                  return;
               }

               let form = new FormData();
               form.append('nombre', app.newBebidaNombre);
               form.append('precio', parseFloat(app.newBebidaPrecio).toFixed(2));
               form.append('restauranteId', app.restaurante.id);
               form.append('file', app.newBebidaImageFile);

               fetch("{{ url('/categoria/AddNewProductoBebida') }}", {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "post",
                  credentials: "same-origin",
                  body: form
               }).then(response => response.json())
                 .then(data => {
                     app.showNewProductoBebida(data);
                 });

               this.newBebidaNombre = '';
               this.newBebidaPrecio = null;
               this.newBebidaImageFile = '';
               this.addNewCardBebida = false;
            },

            showNewProductoBebida: function(producto){
               this.categorias.bebidas.push({
                  id: producto.id,
                  nombre: producto.nombre,
                  precio: parseFloat(producto.precio).toFixed(2),
                  imagen: producto.imagen,
                  status: "1"
               })
            },

            eliminarBebida: function(id){
               // eliminar en interfaz:
               this.categorias.bebidas = this.categorias.bebidas.filter(producto => producto.id !== id);

               // eliminar en la base de datos:
               fetch(`{{ url('/categoria/eliminarBebida') }}/${id}`, {
                  headers: {
                     "Accept": "application/json",
                     "X-Requested-With": "XMLHttpRequest",
                     "X-CSRF-Token": token
                  },
                  method: "delete",
               }).then(response => response.json())
                 .then(data => console.log(data));
            },
            // END BEBIDAS
            imageWithUrl: function (imagen){
               return `${this.url}${imagen}`;
            },

            showImageInModal: function(source, image_izquierda_modal, modal){
               document.getElementById(image_izquierda_modal).src = source;
               $(modal).modal('show');
            },
         }
      });


      // CROPPER
      $('#ventanaModal').on('shown.bs.modal', function() {
         CROPPER = new Cropper(document.getElementById('imagen_original_izquierda'), {
            aspectRatio: 1,
            viewmode: 3,
            preview: ".preview_imagen_recortada",
         });
      }).on('hidden.bs.modal', function() {
         document.querySelector('#original_image').value = "";
         CROPPER.destroy();
         CROPPER = null;
         app.categoria_que_esta_mostrando_la_ventana_modal = null;
      });

   </script>
@endsection

