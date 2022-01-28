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
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Usuario</h2>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ooops!</strong> Error al ingresar los datos, favor volver a intentar.r>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'id' => 'ActualizarData']) !!}
<div class="row" align="center">
    <div class="col-4">
        <div class="form-group">
            <strong>Nombre:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'nombre')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Cédula:</strong>
            {!! Form::text('cedula', null, array('placeholder' => 'Cédula','class' => 'form-control', 'readonly', 'id' => 'cedula')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Celular:</strong>
            {!! Form::text('celular', null, array('placeholder' => 'Celular','class' => 'form-control', 'id' => 'celular')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'readonly', 'id' => 'email')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Fecha Nacimiento:</strong>
            {!! Form::text('fechanac', null, array('placeholder' => 'Fecha Nacimiento','class' => 'form-control', 'id' => 'fecha')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Ciudad</strong>
            {!! Form::text('codciudad', null, array('placeholder' => 'Ciudad','class' => 'form-control', 'id' => 'fecha')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'id' => 'password')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'confirm-password')) !!}
        </div>
    </div>
</div>
<button type="button" class="btn btn-success" id="agregar" onclick="Actualizar();">Agregar</button>
<a href="{{ route('users.index') }}" class="btn btn-primary">Atrás</a>
{{ Form::close() }}
<script type="text/javascript">
    $('#fecha').datepicker({
        format: "yyyy-mm-dd",
        uiLibrary: "bootstrap4",
    });
    function Actualizar()
    {
        if ($("#nombre").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un nombre.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#nombre").val().length > 100)
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un nombre menor a 100 caracteres.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#fecha").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar una fecha.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#password").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar una contraseña.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#confirm-password").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar nuevamente la contraseña.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#confirm-password").val() != $("#password").val())
        {
            Swal.fire({
                title: 'Error!',
                text: 'Las contraseñas no coinciden.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#password").val().length < 8)
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar una contraseña mayor o igual a 8 dígitos.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#confirm-password").val().length < 8)
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar una contraseña mayor o igual a 8 dígitos.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#celular").val().length > 0)
        {
            if ($("#celular").val().length > 10)
            {
                Swal.fire({
                    title: 'Error!',
                    text: 'Debe colocar un número de celular máximo de 10 dígitos.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return false;
            }
        }
        $("#ActualizarData").submit();
    }
</script>
</body>
</html>