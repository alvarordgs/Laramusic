@extends('painel.templates.template')

@section('content')
    <div class="container">

        <h1 class="title">
            Gestão de Usuário
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif

        @if( isset($data))
            <form method="POST" action="/painel/user/editar/{{$data->id}}" class="form">
        @else
            <form method="POST" action="/painel/user/cadastrar" class="form">
        @endif
                {{csrf_field()}}

                <div class="form-group">
                    <input type="text" name="name" placeholder="Insira o nome do usuário" class="form-control" value="{{$data->name or old('nome')}}">
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Insira o e-mail" class="form-control" value="{{$data->email or old('email')}}">
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Insira a senha do usuário" class="form-control" value="{{old('password')}}">
                </div>

                <div class="form-group">
                    <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
                </div>
            </form>
    </div>
@endsection