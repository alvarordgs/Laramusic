@extends('painel.templates.template')

@section('content')

<div class="relatorios">
    <div class="container">
        <ul class="relatorios">
            <div class="row">
                <li class="col-md-6" text-center>
                    <a href="{{url('/painel/estilos')}}">
                        <img src="{{url('assets/painel/imgs/estilos-laramusic.png')}}" alt="Estilos" class="img-menu">
                        <h1>Estilos</h1>
                    </a>
                </li>

                <li class="col-md-6" text-center>
                    <a href="/painel/albuns">
                        <img src="{{url('assets/painel/imgs/albuns-laramusic.png')}}" alt="Albuns" class="img-menu">
                        <h1>Álbuns</h1>
                    </a>
                </li>

                <li class="col-md-6" text-center>
                    <a href="/painel/musicas">
                        <img src="{{url('assets/painel/imgs/music-laramusic.png')}}" alt="Musicas" class="img-menu">
                        <h1>Músicas</h1>
                    </a>
                </li>

                <li class="col-md-6" text-center>
                    <a href="/painel/usuarios">
                        <img src="{{url('assets/painel/imgs/perfil-laramusic.png')}}" alt="Meu Perfil" class="img-menu">
                        <h1>Usuários</h1>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</div> <!-- Relatorios -->

@endsection