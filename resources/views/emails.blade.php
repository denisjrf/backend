<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Mailer' }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="row" align="center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Creación de Email</h2>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ooops!</strong> Error al ingresar los datos, favor volver a intentar.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="container-fluid" align="center">
    <div class="card-body-notificacion">
        {{ Form::open(array('route' => 'enviarEmail', 'id' => 'GuardarEmail')) }}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('asunto', 'Asunto:') }}
                        {{ Form::text('asunto', '', array('class' => 'form-control', 'id' => 'asunto')) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('email', 'Destinatario') }}
                        {{ Form::email('destinatario', '', array('class' => 'form-control', 'id' => 'email')) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('cuerpo', 'Cuerpo:') }}
                        {{ Form::textarea('cuerpo', '', array('class' => 'form-control', 'id' => 'cuerpo')) }}
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" id="agregar" onclick="Guardar();">Enviar</button>
        <a href="{{ route('home') }}" class="btn btn-primary">Atrás</a>
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
    function Guardar()
    {
        if ($("#asunto").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un asunto.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#email").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un correo electrónico.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#email").val().length > 0)
        {
            if ($("#email").val().indexOf("@", 0) == -1 || $("#email").val().indexOf(".", 0) == -1)
            {
                Swal.fire({
                    title: 'Error!',
                    text: 'Debe colocar un correo electrónico válido.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return false;
            }
        }
        if ($("#cuerpo").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar el cuerpo del correo.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        $("#GuardarEmail").submit();
    }
</script>
</body>
</html>