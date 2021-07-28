@extends('auth.templates.template')

@section('content-form')
        <form method="POST" action="/password/reset" class="login form">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

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
                <button type="submit" class="btn btn-dark">
                    Resetar senha
                </button>
            </div>
        </form>
@endsection