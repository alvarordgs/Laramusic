@extends('painel.templates.template')

@section('content')

    <!-- Filters and Actions -->
    <div class="actions">
        <div class="actions__add">
            <a href="{{url('/painel/musica/cadastrar')}}" class="add">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="actions__form">
            <form method="post" action="/painel/musica/pesquisar">
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
            Listagem das músicas
        </h1>

        <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th style="width:100px;">Ações</th>
            </tr>

            @forelse( $data as $musica )

            <tr>
                <td>{{$musica->id}}</td>
                <td>{{$musica->nome}}</td>
                <td>
                    <a href="{{url("/painel/musica/editar/$musica->id")}}" class="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>

                    <a href="{{url("/painel/musica/deletar/$musica->id")}}" class="delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="90">Não existem músicas cadastrados</td>
                </tr>
            @endforelse
        </table>

        <nav>
            {!! $data->render()!!}
        </nav>
    </div>

@endsection