<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Foodzinder | Solicitar registro</title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('plantilla/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('plantilla/img/img-compartir.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('plantilla/img/img-compartir.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('plantilla/img/img-compartir.png')}}">
    <!-- Bootstrap core CSS-->
    <link href="{{asset('plantilla/admin_section/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{asset('plantilla/admin_section/css/admin.css')}}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{asset('plantilla/admin_section/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Plugin styles -->
    <link href="{{asset('plantilla/admin_section/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <!-- Your custom styles -->
    <link href="{{asset('plantilla/admin_section/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- VUEJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <link rel="stylesheet" href="{{asset('public/css/crearRestaurante.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.css" integrity="sha512-jO9KUHlvIF4MH/OTiio0aaueQrD38zlvFde9JoEA+AQaCNxIJoX4Kjse3sO2kqly84wc6aCtdm9BIUpYdvFYoA==" crossorigin="anonymous" />
    <link href="{{asset('plantilla/css/home.css')}}" rel="stylesheet">
    <link href="{{asset('plantilla/css/booking-sign_up.css')}}" rel="stylesheet">
    <style>
        @media (min-width: 992px){
            .content-wrapper {
                margin-left: 0px !important;
            }
        }
    </style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->

@if (session('Notificacion'))
        <!-- Modal -->
    <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{session('Notificacion')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
@endif

    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('plantilla/img/logo.svg')}}" data-retina="true" alt="logo" width="142" height="36"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- /Navigation-->


<div class="container-fluid p-4">
    <div class="container margin_login">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="sign_up">
                    <div class="head">
                        <div class="title">
                        <h3>Contactar</h3>
                    </div>
                    </div>
                    <!-- /head -->
                    <form method="POST" action="{{ route('directorio.enviarCorreo') }}">
                        @csrf
                        <div class="main">
                            <div class="form-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="*Nombre completo" required autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_pencil"></i>
                            </div>
                            <div class="form-group">
                                <input id="restaurante" type="text" class="form-control @error('restaurante') is-invalid @enderror" name="restaurante" value="{{ old('restaurante') }}" placeholder="Nombre del restaurante" autocomplete="restaurante">
                                @error('restaurante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_pencil"></i>
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="*Email" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_mail"></i>
                            </div>
                            <div class="form-group">
                                <select  name="ciudad" class="form-control @error('email') is-invalid @enderror" required id="ciudad">
                                    <option value="">*Ciudad</option>
                                    <option value="Madrid">Madrid</option>
                                    <option value="Barcelona">Barcelona</option>
                                    <option value="Sevilla">Sevilla</option>
                                    <option value="Bilbao">Bilbao</option>
                                    <option value="Zaragoza">Zaragoza</option>
                                    <option value="Granada">Granada</option>
                                    <option value="Córdoba">Córdoba</option>
                                    <option value="San Sebastián">San Sebastián</option>
                                    <option value="Salamanca">Salamanca</option>
                                    <option value="Valencia">Valencia</option>
                                    <option value="Toledo">Toledo</option>
                                    <option value="Burgos">Burgos</option>
                                    <option value="Málaga">Málaga</option>
                                    <option value="Tarifa">Tarifa</option>
                                    <option value="Bolonia, Cádiz">Bolonia, Cádiz</option>
                                </select>
                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_mail"></i>
                            </div>
                            <div class="form-group">
                                <input id="telefono" type="telefono" class="form-control @error('telefono') is-invalid @enderror" name="telefono" placeholder="*Teléfono" required autocomplete="telefono">
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_lock"></i>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control @error('telefono') is-invalid @enderror" id="mensaje" name="mensaje" rows="3" required placeholder="*Mensaje" autocomplete="mensaje"></textarea>
                                @error('mensaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="icon_lock"></i>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input m-2" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" >
                                    Acepto las condiciones legales y la política de protección de datos.
                                </label>
                                <small id="help" class="form-text text-muted">Los campos con * son obligatorios.</small>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="mb-1 w-100 btn-form btn btn-primary" disabled>
                                Enviar
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

    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © FOOGRA 2020</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plantilla/admin_section/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('plantilla/admin_section/vendor/chart.js/Chart.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/jquery.selectbox-0.2.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/retina-replace.min.js')}}"></script>
    <script src="{{asset('plantilla/admin_section/vendor/jquery.magnific-popup.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('plantilla/admin_section/js/admin.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{asset('plantilla/admin_section/js/admin-charts.js')}}"></script>

    <!-- Cropper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.js" integrity="sha512-1bpfZkKJ+WlmJN/I2KLm79dSiuOos0ymwL5IovsUVARyzcaf9rSXsVO2Cdg4qlKNOQXh8fd1d0vKeY9Ru3bQDw==" crossorigin="anonymous"></script>
    <!--custom js-->
    <script src="{{asset('public/js/crearRestaurante.js')}}"></script>

    <script>
        $("#modalMensaje").modal('show');
    </script>
</body>

</html>
