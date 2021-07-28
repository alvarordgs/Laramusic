@extends('painel.templates.template')

@section('content')

    <!-- Filters and Actions -->
    <div class="actions">
        <div class="actions__add">
            <a href="{{url("/painel/album/{$album->id}/musicas/cadastrar")}}" >
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="actions__form">
            <form method="post" action="/painel/album/musicas/{{$album->id}}">
                {{csrf_field()}}
                <input type="text" name="pesquisar" placeholder="Pesquisar">
                <!--<input type="submit" name="pesquisar" value="Encontrar" class="btn btn-danger ml-2">-->
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>

    <div class="clear"></div>

    <div class="container">

        <h1 class="title">
            Listagem das músicas do álbum <b>{{$album->nome}}</b>
        </h1>

        <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th style="width:150px;">Ações</th>
            </tr>

            @forelse( $musicas as $musica )

                <tr>
                    <td>{{$musica->id}}</td>
                    <td>{{$musica->nome}}</td>
                    {{--<td>{{$musica->estilo}}</td>--}}
                    <td>
                        <a href="{{url("/painel/album/$album->id/musicas/deletar/$musica->id")}}" class="delete">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="90">Não existem músicas neste álbum</td>
                </tr>
            @endforelse
        </table>

    </div>

@endsection