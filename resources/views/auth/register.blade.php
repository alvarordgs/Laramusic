@extends('auth.templates.template')

@section('content-form')

        <form method="POST" action="/auth/register" class="login form">
            {!! csrf_field() !!}

            <div class="form-group">
                Nome
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            </div>

            <div class="form-group">
                E-mail
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="form-group">
                Senha
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                Confirmar senha
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark">Registrar</button>
            </div>
        </form>

@endsection