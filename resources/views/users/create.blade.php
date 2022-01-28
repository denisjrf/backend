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
            <h2>Nuevo Usuario</h2>
        </div>
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
@php($ciudad = "")
<div class="container-fluid" align="center">
    <div class="card-body-notificacion">
        {{ Form::open(array('route' => 'users.store', 'id' => 'guardarData')) }}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('nombre', 'Nombre:') }}
                        {{ Form::text('name', '', array('class' => 'form-control', 'id' => 'nombre', 'maxlength' => 100)) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('cedula', 'Cédula:') }}
                        {{ Form::text('cedula', '', array('class' => 'form-control', 'id' => 'cedula', 'maxlength' => 11)) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('celular', 'Celular:') }}
                        {{ Form::text('celular', '', array('class' => 'form-control', 'id' => 'celular', 'maxlength' => 10)) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('email', 'Correo') }}
                        {{ Form::email('email', '', array('class' => 'form-control', 'id' => 'email', 'maxlength' => 100)) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('fecha', 'Fecha de Nacimiento') }}
                        {{ Form::text('fechanac', '', array('class' => 'form-control', 'id' => 'fecha', 'placeholder' => '2000/01/01')) }}
                    </div>
                </div>
                <div class="col-4">
                    {{ Form::label('pais', 'pais') }}
                    <select class="form-control" name="codpais" id="codpais" style="text-transform: uppercase;">
                        <option value="" selected>País</option>
                        @foreach($pais as $pais)
                            <option style="text-transform: uppercase;" value="{{$pais['id']}}">{{$pais['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    {{ Form::label('estado', 'Estado') }}
                    <select class="form-control" name="estado" id="estado" style="text-transform: uppercase;">
                        <option value="" selected disabled="" hidden="">Estado</option>
                    </select>
                </div>
                <div class="col-4">
                    {{ Form::label('ciudad', 'Ciudad') }}
                    <select class="form-control" name="codciudad" id="codciudad" style="text-transform: uppercase;">
                        <option value="" selected disabled="" hidden="">Ciudad</option>
                    </select>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('password', 'Contraseña') }}<br>
                        {{ Form::password('password', array('class' => 'form-control', 'id' => 'password')) }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        {{ Form::label('password', 'Confirmar Contraseña') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation')) }}
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" id="agregar" onclick="Agregar();">Agregar</button>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Atrás</a>
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
    $('#fecha').datepicker({
        format: "yyyy-mm-dd",
        uiLibrary: "bootstrap4",
    });
    //Cargamos id del pais
    $("#codpais").change(function(){
        Estados();
    });
    //buscamos el estado con el id del pais seleccionado
    function Estados()
    {
        let pais = $("#codpais").val();
        let url ='http://127.0.0.1:8000/Estados';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            data: {
                pais: pais,
            },
            beforeSend: function (){
                $("#estado").html('<option value="" selected disabled="" hidden="">Procesando...</option>');
            },
            success: function (response) {
                let obj = response;
                $("select#estado").empty();
                $("select#estado").append('<option value="" selected disabled="" hidden="">Estado</option>');
                if(obj != "" || obj != 'undefined')
                {
                    Estado = obj[0];
                    codigo = Estado.id;
                    nombre = Estado.nombre;
                    $("select#estado").append('<option value="'+codigo+'" title="'+nombre+'" style="text-transform: uppercase;">'+nombre+'</option>');
                }
            }
        });
    }
    //buscamos la ciudad con el estado seleccionado
    $("#estado").change(function(){
        if ($("#estado").val() > 0)
        {
            Ciudad();
            function Ciudad()
            {
                let estado = $("#estado").val();
                let url ='http://127.0.0.1:8000/Ciudad';
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    data: {
                        estado: estado,
                    },
                    beforeSend: function (){
                        $("#codciudad").html('<option value="" selected disabled="" hidden="">Procesando...</option>');
                    },
                    success: function (response) {
                        let obj = response;
                        $("select#codciudad").empty();
                        $("select#codciudad").append('<option value="" selected disabled="" hidden="">Ciudad</option>');
                        if(obj != "" || obj != 'undefined')
                        {
                            Ciudad = obj[0];
                            codigo = Ciudad.id;
                            nombre = Ciudad.nombre;
                            $("select#codciudad").append('<option value="'+codigo+'" title="'+nombre+'" style="text-transform: uppercase;">'+nombre+'</option>');
                        }
                    }
                });
            }
        }
    });
    //Solo números en los input pago móvil, tarjeta de crédito
    $("#celular").on("input", function ()
    {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
    //Validamos los campos antes de guardar
    function Agregar()
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
        if ($("#cedula").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un número de cédula.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#cedula").val().length > 11)
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar un número de cédula máximo de 11 dígitos.',
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
        //Validamos que el usuario a registrar sea mayor de edad.
        if($("#fecha").val().length > 0)
        {
            function calcularEdad()
            {
                let fecha = $("#fecha").val();
                let hoy = new Date();
                let cumpleanos = new Date(fecha);
                let edad = hoy.getFullYear() - cumpleanos.getFullYear();
                let m = hoy.getMonth() - cumpleanos.getMonth();
                if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate()))
                {
                    edad--;
                }
                return edad;
            }
            let edad = calcularEdad(fecha);
            if (edad < 18)
            {
                Swal.fire({
                    title: 'Error!',
                    text: 'El usuario debe ser mayor de edad para poder registrarlo, tiene ' +edad+ ' años de edad.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return false;
            }
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
        if ($("#password_confirmation").val() == "")
        {
            Swal.fire({
                title: 'Error!',
                text: 'Debe colocar nuevamente la contraseña.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }
        if ($("#password_confirmation").val() != $("#password").val())
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
        if ($("#password_confirmation").val().length < 8)
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
        $("#guardarData").submit();
    }
</script>
</body>
</html>