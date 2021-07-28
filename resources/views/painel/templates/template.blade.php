<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>{{$titulo or 'Dashboard Laramusic'}}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{url('assets/all/css/font-awesome.min.css')}}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/painel/css/laramusic-painel.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{url('assets/painel/imgs/favicon-laramusic.png')}}">
</head>
<body>

<div class="menu">
    <ul class="menu col-md-12">
        <div class="row">
            <li class="col-md-2" text-center>
                <a href="{{url('/painel')}}">
                    <img src="{{url('assets/painel/imgs/laramusic-branca.png')}}" alt="LaraMusic" class="logo">
                </a>
            </li>

            <li class="col-md-2" text-center>
                <a href="{{url('/painel/estilos')}}">
                    <img src="{{url('assets/painel/imgs/estilos-laramusic.png')}}" alt="Estilos" class="img-menu">
                    <h1>Estilos</h1>
                </a>
            </li>

            <li class="col-md-2" text-center>
                <a href="{{url('/painel/albuns')}}">
                    <img src="{{url('assets/painel/imgs/albuns-laramusic.png')}}" alt="Albuns" class="img-menu">
                    <h1>Álbuns</h1>
                </a>
            </li>

            <li class="col-md-2" text-center>
                <a href="{{url('/painel/musicas')}}">
                    <img src="{{url('assets/painel/imgs/music-laramusic.png')}}" alt="Musicas" class="img-menu">
                    <h1>Músicas</h1>
                </a>
            </li>

            <li class="col-md-2" text-center>
                <a href="{{url('/painel/usuarios')}}">
                    <img src="{{url('assets/painel/imgs/perfil-laramusic.png')}}" alt="Meu Perfil" class="img-menu">
                    <h1>Usuários</h1>
                </a>
            </li>

            <li class="col-md-2" text-center>
                <a href="{{url('/auth/logout')}}">
                    <img src="{{url('assets/painel/imgs/sair-laramusic.png')}}" alt="Sair" class="img-menu">
                    <h1>Sair</h1>
                </a>
            </li>
        </div>
    </ul>
</div> <!-- Menu -->

<div class="clear"></div>

<!-- Content Dinâmico -->
@yield('content')

<div class="clear"></div>

<footer>
    <div class="container text-center">
        <p class="footer">
            LaraMusic &copy; Todos os direitos reservados
        </p>
    </div>
</footer>

<!--jquery-->
<script src="{{url('assets/painel/js/jquery.js')}}"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
