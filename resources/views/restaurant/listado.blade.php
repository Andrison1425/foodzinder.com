@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Listado de restaurantes
@endsection

@section('content')

<div class="container-fluid p-2 mt-5">
    <div class="row">
    <div class="col text-center">
    <h4>Restaurantes Registrados:</h4>
    </div>
    </div>
    <div class="row">
    <div class="col" style="overflow:auto;">
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
        <tbody class="tbody">
            @foreach ($restaurantes as $resto)
                <tr class="fila" id="{{$loop->index}}">
                    <td class="text-center">
                        <a href="{{ url('/restaurant/show/'.$resto->id) }}">{{ $resto->nombre }}</a>
                    </td>
                    <td class="text-center">{{ $resto->direccion }}</td>
                    <td class="text-center">{{ $resto->telefono }}</td>
                    <td class="text-center">{{ $resto->status === "1" ? "Habilitado" : "No aparecerá en el buscador" }}</td>
                    <td class="text-center d-flex justify-content-center">
                    <a class="m-1" href="{{ route('restaurant.edit', ['id' => $resto->id]) }}">
                        <button type="button" class="btn btn-success btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a class="m-1" href="{{ route('categorias.index', ['id' => $resto->id]) }}">
                        <button type="button" class="btn btn-info btn-sm">Ver Categorías</button>
                    </a>

                    <a class="m-1" href="{{ route('restaurant.cambiar_status', ['id' => $resto->id]) }}">
                        <button type="button" class="btn btn-{{ $resto->status === "2" ? "success" : "warning" }} btn-sm">{{ $resto->status === "1" ? "Inhabilitar" : "Habilitar" }}</button>
                    </a>

                    <a class="m-1" href="#">
                        <form method="POST" class="formEliminar" action="{{ route('restaurant.destroy', ['id' => $resto->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
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

@endsection

@section('scripts')
<script>

    $('#tabla_listado_restaurantes').DataTable();

    document.querySelectorAll(".formEliminar").forEach(form=>{
        form.onsubmit=e=>{
            e.preventDefault();
            let confirmar=confirm("¿Seguro que desea eliminar este restaurante? Los cambios son permanentes");
            if(confirmar){
                form.submit();
            }
        }
    });


</script>
@endsection
