@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Listado de restaurantes
@endsection

@section('custom-links')
<style>
    .mostrarBoton{
        display:block !important;
    }
</style>

@endsection

@section('content')

<form method="POST" action="{{ route('restaurant.cambiarPrioridad') }}">
    @csrf
    <input type="hidden" name="prioridad" class="posiciones" value="[]">
    <input class="btn btn-success d-none guardarCambios float-right m-2" type="submit" value="Guardar cambios">
</form>
<div class="container-fluid p-2 mt-5">
    <div class="row">
    <div class="col text-center">
    <h4>Restaurantes con prioridad:</h4>
    </div>
    </div>
    <div class="row">
    <div class="col" style="overflow:auto;">
        <div class="cont-list drag-sort-enable w-100 list-group list-group-flush contenedor">
            @foreach ($restaurantes as $resto)
                <li class="agarrar d-flex justify-content-between list-group-item fila" data-pos="{{$resto->id}}">
                    <div class="cont-flechas" style="font-size:1.5rem;">
                        <i class="fa fa-arrow-up flechas-up" role="button" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down flechas-down" role="button" aria-hidden="true"></i>
                    </div>
                    <p style="flex:1;" class="pl-4 m-0 d-flex align-items-center">
                        <a href="{{ url('/restaurant/show/'.$resto->id) }}">{{ $resto->nombre }}</a>
                    </p>
                    <a class="m-1" href="{{ route('restaurant.edit', ['id' => $resto->id]) }}">
                        <form method="POST" action="{{ route('restaurant.quitarPrioridad',['id'=>$resto->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Quitar prioridad</button>
                        </form>
                    </a>
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

    flechasUp.forEach((flecha,i)=>{
        flecha.onclick=e=>{
            contenedor.insertBefore(flecha.parentNode.parentNode,flecha.parentNode.parentNode.previousElementSibling);
        }
    });

    flechasDown.forEach((flecha,i)=>{
        flecha.onclick=e=>{
            contenedor.insertBefore(flecha.parentNode.parentNode.previousElementSibling,flecha.parentNode.parentNode);
        }
    });
</script>
@endsection
