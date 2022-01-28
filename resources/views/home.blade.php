@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenidos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(@Auth::user()->hasRole('Admin'))
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                        <a href="{{ route('emailsEnviados') }}" class="btn btn-success">Ver Correos</a>
                    @endif
                    <a href="{{ route('email') }}" class="btn btn-primary">Enviar Correo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
