@extends('painel.templates.template')

@section('content')

    <!-- Filters and Actions -->
    <div class="actions">
        <div class="actions__form">
            <form method="post" action="/painel/album/{{$album->id}}/musicas/pesquisar">
                {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar" class="mb-2">
                <!--<input type="submit" name="pesquisar" value="Encontrar" class="btn btn-danger ml-2">-->
                <button type="submit"><i class="fa fa-search " aria-hidden="true"></i></button>
            </form>
        </div>
    </div>

    <div class="clear"></div>

    <div class="container">

        <h1 class="title">
            Adicionar novas músicas ao álbum <b>{{$album->nome}}</b>
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif

            <form method="POST" action="/painel/album/{{$album->id}}/musicas/cadastrar" class="form" enctype="multipart/form-data">
                {{csrf_field()}}

                @foreach( $musicas as $musica )
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="musicas[]" value="{{$musica->id}}"> {{$musica->nome}}
                    </label>
                </div>
                @endforeach

                <div class="form-group">
                    <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
                </div>
            </form>
    </div>
@endsection