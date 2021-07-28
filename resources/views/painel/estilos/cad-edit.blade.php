@extends('painel.templates.template')

@section('content')
    <div class="container">

        <h1 class="title">
            Gestão de Estilo
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif

        @if( isset($data))
            <form method="POST" action="/painel/estilos/editar/{{$data->id}}" class="form">
        @else
            <form method="POST" action="/painel/estilos/cadastrar" class="form">
        @endif
                {{csrf_field()}}

                <div class="form-group">
                    <input type="text" name="nome" placeholder="Insira o nome do estilo" class="form-control" value="{{$data->nome or old('nome')}}">
                </div>

                <div class="form-group">
                    <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
                </div>
            </form>
    </div>
@endsection