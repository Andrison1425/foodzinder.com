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
        <div class="cont-list drag-sort-enable w-100 list-group list-group-flush">
            @foreach ($restaurantes as $resto)
                <li class="agarrar d-flex justify-content-between list-group-item" data-pos="{{$resto->id}}">
                    <a href="{{ url('/restaurant/show/'.$resto->id) }}">{{ $resto->nombre }}</a>
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
/* Made with love by @fitri
 This is a component of my ReactJS project
 https://codepen.io/fitri/full/oWovYj/ */
 function enableDragSort(listClass) {
  const sortableLists = document.getElementsByClassName(listClass);
  Array.prototype.map.call(sortableLists, (list) => {enableDragList(list)});
}

function enableDragList(list) {
  Array.prototype.map.call(list.children, (item) => {enableDragItem(item)});
}

function enableDragItem(item) {
  item.setAttribute('draggable', true)
  item.ondrag = handleDrag;
  item.ondragend = handleDrop;
}

function handleDrag(item) {
  const selectedItem = item.target,
        list = selectedItem.parentNode,
        x = event.clientX,
        y = event.clientY;

  selectedItem.classList.add('drag-sort-active');
  let swapItem = document.elementFromPoint(x, y) === null ? selectedItem : document.elementFromPoint(x, y);

  if (list === swapItem.parentNode) {
    swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
    list.insertBefore(selectedItem, swapItem);
  }
}

function handleDrop(item) {
    arrPos=[];
    document.querySelectorAll(".agarrar").forEach(ele=>{
        arrPos.push(ele.getAttribute("data-pos"));
        document.querySelector(".guardarCambios").classList.add("mostrarBoton");
        document.querySelector(".posiciones").value=JSON.stringify(arrPos);
    })
    console.log(arrPos)

  item.target.classList.remove('drag-sort-active');
}

(()=> {enableDragSort('drag-sort-enable')})();

    </script>
@endsection
