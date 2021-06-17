@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder Listado de restaurantes
@endsection

@section('content')

<div class="container-fluid p-2 mt-5">
    <div>
        <div class="text-center title-listado">
            <h4 class="title-table">Lista de restaurantes</h4>
        </div>
    </div>
    <div class="row">
    <div class="col" style="overflow:auto;">
    <table id="tabla_listado_restaurantes" class="table  table-bordered" style="width:100%">
        <thead class="d-none">
            <tr>
                <th> a</th>
            </tr>
        </thead>
        <tbody class="tbody">
            @foreach ($restaurantes as $resto)
                <?php
                    if(is_int($resto) || !$resto->imagenes ||$resto->nombre!=='Algo2 dfg'){
                        continue;
                    }else{
                        $imagenes=json_decode($resto->imagenes,true);
                        $imagen=$imagenes[0];
                    }
                ?>
                <tr class="fila" id="{{$loop->index}}" data-pos="{{$resto->id}}">
                    <td class="p-3 p-md-5 d-flex" style="">
                        <img class="img-resto" src="{{asset('public/'.$imagen)}}" alt="">
                        <div class="cont-sec-right d-flex justify-content-between h-100 flex-column">
                            <div class="d-flex cont-encabezado justify-content-between">
                                <span class="d-flex">
                                    <a href="{{ url('/restaurant/show/'.$resto->id) }}">
                                        <h2>
                                            {{ $resto->nombre }}
                                        </h2>
                                    </a>
                                    <span style="padding-top:0.7rem;">
                                        <span class="text-center status-info @if($resto->status == '1'){{'bg-success'}}@else{{'bg-danger'}}@endif">{{ $resto->status === "1" ? "Habilitado" : "Deshabilitado" }}</span>
                                    </span>
                                </span>
                                <span class="d-flex cont-opc-rest">
                                    <a class="m-1" href="{{ route('restaurant.edit', ['id' => $resto->id]) }}">
                                        <button type="button" class="btn btn-sm">
                                            <i class="icon_pencil-edit edit-orden mr-2"></i>
                                            Editar
                                        </button>
                                    </a>
                                    <a class="m-1" href="{{ route('restaurant.cambiar_status', ['id' => $resto->id]) }}">
                                        <button type="button" class="btn btn-sm">
                                            @if($resto->status === "1")
                                                <i class='fa fa-eye-slash mr-2' aria-hidden='true'></i>{{'Deshabilitar'}}
                                            @else
                                                <i class='fa fa-eye mr-2' aria-hidden='true'></i>{{'Habilitar'}}
                                            @endif
                                        </button>
                                    </a>
                                    <a class="m-1" href="#">
                                        <form method="POST" class="formEliminar" action="{{ route('restaurant.destroy', ['id' => $resto->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm">
                                                <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>
                                                Eliminar
                                            </button>
                                        </form>
                                    </a>
                                </span>
                            </div>

                            <div class="cont-info-sec d-flex flex-column">
                                <span>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{ $resto->direccion }}
                                </span>
                                <span>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    {{ $resto->telefono }}
                                </span>
                            </div>
                            <span>
                                <a class="cont-btn-ver" href="{{ route('categorias.index', ['id' => $resto->id]) }}">
                                    <button type="button" class="btn btn-ver btn-sm">Ver restaurante</button>
                                </a>
                            </span>
                        </div>
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

    let table=$('#tabla_listado_restaurantes').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ restaurantes por páginas",
            "zeroRecords": "Ningún restaurante encontrado",
            "info": "Mostrando _PAGE_ de _PAGES_ resultados",
            "infoEmpty": "Ningún resultado",
            "infoFiltered": "(filtrado de _MAX_ total restaurantes)",
            "paginate":{
                'next':'Siguiente',
                'previous':'Anterior'
            }
        }
    });

    document.querySelectorAll(".formEliminar").forEach(form=>{
        form.onsubmit=e=>{
            e.preventDefault();
            let confirmar=confirm("¿Seguro que desea eliminar este restaurante? Los cambios son permanentes");
            if(confirmar){
                form.submit();
            }
        }
    });

    function editarPos(e){
        let newId=Number(prompt("Ingrese la nueva posición"));
        if(newId==NaN || newId<1){

        }else{
            e.target.previousElementSibling.innerHTML=newId;
            table.rows().invalidate().draw();
            var data = table.rows().data();

            console.log(data)
        }
    }

    // document.querySelectorAll(".edit-orden").forEach(ele=>{
    //     ele.onclick=e=>{
    //         let newId=Number(prompt("Ingrese la nueva posición"));

    //         if(newId==NaN || newId<1){

    //         }else{
    //             ele.previousElementSibling.innerHTML=newId;
    //             table.rows().invalidate().draw();
    //         }
    //     }
    // });

    let buscador=document.querySelector("#tabla_listado_restaurantes_filter>label");

    buscador.removeChild(buscador.childNodes[0]);
    buscador.childNodes[0].setAttribute("placeholder","Filtrar");
    buscador.childNodes[0].classList.add("inputBuscar");
    let icono=document.createElement("i");
    icono.classList.add('fa','fa-search')
    icono.id="icon-buscador";
    buscador.appendChild(icono);
    //buscador.innerHTML+=`<i class="fa fa-search" id="icon-buscador" aria-hidden="true"></i>`;

</script>
@endsection
