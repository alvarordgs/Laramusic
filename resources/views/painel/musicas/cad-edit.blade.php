@extends('painel.templates.template')

@section('content')
    <div class="container">

        <h1 class="title">
            Gestão de Música
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif

        @if( isset($data))
            <form method="POST" action="/painel/musica/editar/{{$data->id}}" class="form" enctype="multipart/form-data">
        @else
            <form method="POST" action="/painel/musica/cadastrar" class="form" enctype="multipart/form-data">
        @endif
                {{csrf_field()}}

                <div class="form-group">
                    <input type="text" name="nome" placeholder="Insira o nome da musica" class="form-control" value="{{$data->nome or old('nome')}}">
                </div>

                <div class="form-group">
                    <input type="file" name="nome_arq" class="form-control">
                </div>

                @foreach( $albuns as $album )
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="albuns[]" value="{{$album->id}}" {{  isset($albuns_checked) ? in_array($album->id, $albuns_checked) ? 'checked' : '' : ''  }} /> {{$album->nome}}
                        </label>
                    </div>
                @endforeach

                <div class="form-group">
                    <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
                </div>

            </form>
    </div>
@endsection