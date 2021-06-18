@extends('restaurant.layouts.admin')

@section('title')
    Lista de Usuarios
@endsection

@section('custom-links')
<style>
    #usuarios{
        color:#f67599;
    }
</style>
@endsection

@section('content')

    <div class="container fluid">
         <div class="row">
            <div class="col-md-12">
               <h3>Actualizar Usuario</h3>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <form action="{{ route('users.update') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $user->id }}">
                  <div class="form-group col-md-6">
                        <input class="form-control" type="text" value="{{ $user->name }}">
                  </div>
                  <div class="form-group col-md-6">
                        <input class="form-control" type="text" value="{{ $user->email }}">
                  </div>
                  <div class="form-group col-md-6">
                      <select name="profile" class="form-control">
                         <option value="" disabled>-- Seleccione --</option>
                         <option {{ ($user->profile === 1) ? 'selected' : "" }} value="1">Administrador</option>
                         <option {{ ($user->profile === 2) ? 'selected' : "" }} value="2">Usuario</option>
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                      <input type="submit" value="Actualizar" class="btn btn-guardar">
                  </div>
               </form>
            </div>
         </div>
      </div>

@endsection

@section('scripts')

@endsection
