@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Dashboard
@endsection

@section('content')

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12 btn-dashboard mb-2">
            <a href="{{route('restaurant.listado')}}">
                Lista de restaurantes
            </a>
        </div>
        <div class="col-md-4 col-sm-6 col-12 btn-dashboard mb-2">
            <a href="{{route('restaurant.create')}}">
                Añadir restaurante
            </a>
        </div>
        <div class="col-md-4 col-sm-6 col-12 btn-dashboard mb-2">
            <a href="">
                Añadir usuario
            </a>
        </div>
    </div>
</div>
@endsection
