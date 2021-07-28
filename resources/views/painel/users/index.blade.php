@extends('painel.templates.template')

@section('content')

    <!-- Filters and Actions -->
    <div class="actions">
        <div class="actions__add">
            <a href="{{url('/painel/user/cadastrar')}}" class="add">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="actions__form">
            <form method="post" action="/painel/usuarios/pesquisar">
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
            Listagem dos Usuários
        </h1>

        <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th style="width:100px;">Ações</th>
            </tr>

            @forelse( $data as $user )

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{url("/painel/user/editar/$user->id")}}" class="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>

                    <a href="{{url("/painel/user/deletar/$user->id")}}" class="delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="90">Não existem usuários cadastrados</td>
                </tr>
            @endforelse
        </table>

        <nav>
            {!! $data->render()!!}
        </nav>
    </div>

@endsection