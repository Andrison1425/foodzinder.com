@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder | Lista de Usuarios
@endsection

@section('custom-links')
@endsection

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <h3>LISTA DE USUARIOS</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Perfil</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{($user->profile === 1) ? "Administrador" : "Usuario"}}</td>
                        <td>
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}">
                                <button class="btn btn-info">Cambiar perfil</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
