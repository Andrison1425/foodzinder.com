@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Listado de restaurantes
@endsection

@section('custom-links')
<style>
    .mostrarBoton{
        display:block !important;
    }

    .pos{
        width: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8080808a;
    }

    a:hover{
        text-decoration: none;
    }

    .cont-flechas{
        border-right: 1px #8080808a solid;
        border-left: 1px #8080808a solid;
        padding:0 14px;
    }

    .cont-flechas i{
        color:#f67599;
    }

    p a{
        color:black;
    }

    #app{
        overflow-x: scroll;
    }


    #ordenar{
        color:#f67599 !important;
    }
</style>

@endsection

@section('content')

<form method="POST" action="{{ route('restaurant.cambiarPrioridad') }}">
    @csrf
    <input type="hidden" name="prioridad" class="posiciones" value="[]">
    <input class="btn btn-guardar d-none guardarCambios float-right m-2" type="submit" value="Guardar cambios">
</form>

<div class="container-fluid p-2 mt-5 d-flex align-items-center flex-column">
    <div class="row">
    <div class="col text-center">
    <h4 style="font-weight:700;">Restaurantes con prioridad:</h4>
    </div>
    </div>
    <div class="row w-100">
    <div class="col" style="min-width:700px; overflow:auto;">
        <div class="cont-list drag-sort-enable w-100 list-group list-group-flush contenedor">
            @foreach ($restaurantes as $resto)
                <?php
                    if(is_int($resto)){
                        continue;
                    }else{
                        $ruta=['id' => $resto->id, 'ciudad'=>strtolower($resto->ciudad), 'name'=>$resto->nombreUrl];
                    }
                ?>
                <li class="agarrar d-flex justify-content-between list-group-item fila pl-1" data-pos="{{$resto->id}}">
                    <div class="pos">
                        {{$loop->index+1}}
                    </div>
                    <div class="cont-flechas" style="font-size:1.5rem;">
                        <i class="fa fa-angle-up flechas-up" role="button" aria-hidden="true"></i>
                        <i class="fa fa-angle-down flechas-down" role="button" aria-hidden="true"></i>
                    </div>
                    <p style="flex:1;" class="pl-4 m-0 d-flex align-items-center">
                        <a href="{{ url('/restaurant/show/'.$resto->id) }}">{{ $resto->nombre }}</a>
                    </p>
                    <div class="cont-opc-rest">
                        <a class="m-1" target="_blank" href="{{ route('directorio.detail', $ruta) }}">
                            <button type="button" class="btn btn-sm">
                                Ver restaurante
                            </button>
                        </a>
                        <a class="m-1" href="{{ route('restaurant.edit', ['id' => $resto->id]) }}">
                            <button type="button" class="btn btn-sm">
                                <i class="icon_pencil-edit edit-orden mr-2"></i>
                                Editar
                            </button>
                        </a>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let flechasUp=document.querySelectorAll(".flechas-up");
    let flechasDown=document.querySelectorAll(".flechas-down");
    let filas=document.querySelectorAll(".fila");
    let contenedor=document.querySelector(".contenedor");
    let arrPos=[];

    flechasUp.forEach((flecha,i)=>{
        flecha.onclick=e=>{
            arrPos=[];
            contenedor.insertBefore(flecha.parentNode.parentNode,flecha.parentNode.parentNode.previousElementSibling);
            document.querySelectorAll(".agarrar").forEach((ele,i)=>{
                document.querySelectorAll(".pos")[i].innerHTML=i+1;
                arrPos.push(ele.getAttribute("data-pos"));
                document.querySelector(".guardarCambios").classList.add("mostrarBoton");
                document.querySelector(".posiciones").value=JSON.stringify(arrPos);
            })
        }
    });

    flechasDown.forEach((flecha,i)=>{
        flecha.onclick=e=>{
            arrPos=[];
            if(flecha.parentNode.parentNode.nextElementSibling==null){
                contenedor.insertBefore(flecha.parentNode.parentNode,document.querySelectorAll(".agarrar")[0]);
            }else{
                contenedor.insertBefore(flecha.parentNode.parentNode.nextElementSibling,flecha.parentNode.parentNode);
            }
            document.querySelectorAll(".agarrar").forEach((ele,i)=>{
                document.querySelectorAll(".pos")[i].innerHTML=i+1;
                arrPos.push(ele.getAttribute("data-pos"));
                document.querySelector(".guardarCambios").classList.add("mostrarBoton");
                document.querySelector(".posiciones").value=JSON.stringify(arrPos);
            })
        }
    });

    let posic=document.querySelectorAll(".pos");
    posic.forEach(ele=>{
        ele.onclick=e=>{
            arrPos=[];
            let newId=Number(prompt("Ingrese la nueva posición"));
            if(isNaN(newId) || newId<1){

            }else{
                if(Number(ele.innerHTML)<newId && newId<posic.length){
                    contenedor.insertBefore(ele.parentNode,posic[newId].parentNode);
                }else if(newId>posic.length){
                    contenedor.insertBefore(ele.parentNode, document.querySelectorAll(".pos")[posic.length-1].parentNode);
                }else{
                    contenedor.insertBefore(ele.parentNode,document.querySelectorAll(".pos")[newId-1].parentNode);
                }
                document.querySelectorAll(".agarrar").forEach((ele,i)=>{
                    document.querySelectorAll(".pos")[i].innerHTML=i+1;
                    arrPos.push(ele.getAttribute("data-pos"));
                    document.querySelector(".guardarCambios").classList.add("mostrarBoton");
                    document.querySelector(".posiciones").value=JSON.stringify(arrPos);
                })
            }
        }
    });
</script>
@endsection
