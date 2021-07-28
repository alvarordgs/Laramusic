@extends('auth.templates.template')

@section('content-form')

    <form method="POST" action="/auth/login" class=" login form">
        {!! csrf_field() !!}

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger m-2">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif

        <div class="form-group" style="margin-top: 5px">
            E-mail
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Insira o e-mail" class="form-control">
        </div>

        <div class="form-group">
            Senha
            <input type="password" name="password" id="password" placeholder="Insira a senha" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-dark" style="margin-bottom: 12px">Entrar</button>
        </div>

        <div class="text-right">
            <a class="btn btn-link" style="text-decoration: none;" href="{{url('/password/email')}}">Esqueceu sua senha?</a>
        </div>
    </form>

@endsection