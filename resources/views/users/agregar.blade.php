@extends('restaurant.layouts.admin')

@section('title')
    Foodzinder | Agregar usuario
@endsection

@section('custom-links')
<link href="{{asset('plantilla/css/home.css')}}" rel="stylesheet">
<link href="{{asset('plantilla/css/booking-sign_up.css')}}" rel="stylesheet">

<style>
    #nuevoUsuario{
        color:#f67599 !important;
    }
</style>

@endsection

@section('content')
<div class="container-fluid p-4">
    <div class="container margin_login">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="sign_up">
                    <div class="head">
                        <div class="title">
                        <h3>Registrar usuario</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="POST" action="{{ route('users.crear') }}">
                        @csrf
                        <div class="main">
                            <div class="form-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre completo" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_pencil"></i>
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_mail"></i>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_lock"></i>
                            </div>
                            <div class="form-group add_bottom_15">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña" autocomplete="new-password">

                                <i class="icon_lock"></i>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="mb-1 w-100 btn btn-primary">
                                Registrar
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /box_booking -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
	</div>
</div>
@endsection

@section('scripts')

@endsection
