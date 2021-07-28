@extends('painel.templates.template')

@section('content')

    <!-- Filters and Actions -->
    <div class="actions">
        <div class="actions__add">
            <a href="{{url('/painel/album/cadastrar')}}" class="add">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="actions__form">
            <form method="post" action="/painel/album/pesquisar">
                {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar">
                <!--<input type="submit" name="pesquisar" value="Encontrar" class="btn btn-danger ml-2">-->
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>

    <div class="clear"></div>

    <div class="container">

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert-danger alert m-2">
                @foreach( $errors as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif

        <h1 class="title">
            Listagem dos álbuns
        </h1>

        <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Estilo</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse( $data as $album )

            <tr>
                <td>{{$album->id}}</td>
                <td>{{$album->nome}}</td>
                <td>{{$album->estilo}}</td>
                <td>
                    <a href="{{url("/painel/album/musicas/$album->id")}}" class="musics">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                            <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z"/>
                            <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z"/>
                            <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z"/>
                        </svg>
                    </a>

                    <a href="{{url("/painel/album/editar/$album->id")}}" class="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>

                    <a href="{{url("/painel/album/deletar/$album->id")}}" class="delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="90">Não existem álbuns cadastrados</td>
                </tr>
            @endforelse
        </table>

        <nav>
            {!! $data->render()!!}
        </nav>
    </div>

@endsection