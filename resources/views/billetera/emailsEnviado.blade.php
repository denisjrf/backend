<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container" style="width: 90%; padding-left:5%;margin-top: 20px">
    <p>Saludos Sr(a) {!! strtoupper($datos["nombre"]) !!} {!! strtoupper($datos["apellido"]) !!}<b></b></p>
    <p>Le informamos que usted ha recibido un correo: <b>{!! date("d-m-Y") !!}</b></p>
    <p> Con los datos para realizar la confirmación de su compra:</p>
    <p><b>Nombre</b>: {!! $datos["nombre"] !!} {!! $datos["apellido"] !!}</p>
    <p><b>Documento</b>: {!! $datos["documento"] !!}</p>
    <p><b>Celular</b>: {!! $datos['celular'] !!}</p>
    <p><b>Id Sessión</b>: {!! $datos['id_session'] !!}</p>
    <p><b>Token</b>: {!! $datos["token"] !!}</p>
    <p><b>Monto</b>: {!! number_format($datos["monto"]) !!}</p>
    <br>
    <p>Favor colocar o indicar el Id de Sessión y Token para confimar el pago de {!! number_format($datos["monto"]) !!}.</p>
    <br>
    <p>En caso de dudas, puedes contactarnos por:<br>
        <li style="list-style: none;">
            <b>Correo Electrónico:</b> <a href="mailto:djramirezfr.19@gmail.com">denisramirez.dj@gmail.com</a>
            <br>
            Gracias.
            <br>
            <b>Billetera de Pagos.</b>
        </li>
    </p>
</div>
</body>
</html>