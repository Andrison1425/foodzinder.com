@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Dashboard
@endsection

@section('custom-links')
    <style>
        #app{
            display: flex;
            align-items: center;
        }

        #tablero{
            color:#f67599 !important;
        }
    </style>
@endsection

@section('content')

<div class="container-fluid p-2">
    <div class="row justify-content-between contRow">
        <div class="col-12 contImgPrin">
            <a href="{{route('index')}}">
                <img src="{{asset('plantilla/img/logo.svg')}}" data-retina="true" alt="logo" class="imgPrin">
            </a>
        </div>
        <div class=" btn-dashboard mb-2">
            <a href="{{route('restaurant.listado')}}">
                <i class="icon_building"></i>
                Restaurantes
            </a>
        </div>
        <div class=" btn-dashboard mb-2">
            <a href="{{route('restaurant.create')}}">
                <i class="icon_mug"></i>
                Añadir nuevo
            </a>
        </div>
        <div class=" btn-dashboard mb-2">
            <a href="{{route('users.index')}}">
                <i class="icon_profile"></i>
                Usuarios
            </a>
        </div>
    </div>
</div>
@endsection
