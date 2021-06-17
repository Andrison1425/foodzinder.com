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
                        <td class="cont-opc-rest d-flex">
                            <a class="m-1" href="{{ route('users.edit', ['id' => $user->id]) }}">
                                <button type="button" class="btn btn-sm">
                                    <i class="icon_pencil-edit edit-orden mr-2"></i>
                                    Editar
                                </button>
                            </a>
                            <a class="m-1" href="#">
                                <form method="POST" class="formEliminar" action="{{route('users.destroy',['id'=>$user->id])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>
                                        Eliminar
                                    </button>
                                </form>
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
<script>
    document.querySelectorAll(".formEliminar").forEach(form=>{
        form.onsubmit=e=>{
            e.preventDefault();
            let confirmar=confirm("¿Seguro que desea eliminar a este usuario? Los cambios son permanentes");
            if(confirmar){
                form.submit();
            }
        }
    });
</script>
@endsection
