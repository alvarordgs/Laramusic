<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8"/>
    <title>{{$titulo or 'LaraMusic'}}</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('assets/all/css/bootstrap.css')}}"/>

    <!-- Fonts Icons CSS-->
    <link rel="stylesheet" href="{{url('assets/all/css/font-awesome.min.css')}}"/>

    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/site/css/laramusic.css')}}"/>

    <!-- RESET -->
    <link rel="stylesheet" href="{{url('assets/site/css/resets.css')}}"/>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{url('assets/site/imgs/favicon-laramusic.png')}}"/>

    <!-- jQuery-->
    <script src="{{url('assets/all/js/jquery-3.6.0.js')}}"></script>

    <!-- Início do jPlayer -->
    <link href="{{url('assets/site/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')}}" rel="stylesheet" />
    <script src="{{url('assets/site/dist/jplayer/jquery.jplayer.min.js')}}"></script>
    <script src="{{url('assets/site/dist/add-on/jplayer.playlist.min.js')}}"></script>

    @stack('scripts-header')
</head>
<body>

<header class="header">
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <a href="{{url('/')}}">
                    <img src="{{url('assets/site/imgs/laramusic.png')}}" alt="LaraMusic" title="LaraMusic" class="img-logo"/>
                </a>
            </div>

            <div class="col-md-7">
                <form class="form-search" method="POST" action="/albuns/pesquisar">
                    {{csrf_field()}}
                    <input type="text" name="pesquisa" placeholder="Pesquisar Álbum"/>
                    <button class="btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>

            <div class="col-md-2">
                <a href="{{url('/auth/login')}}" class="login">Entrar</a>
            </div>
        </div>

    </div> <!-- End Container-->
</header> <!-- End Header -->

<div class="clear"></div>

<hr class="hr">

<!-- Content Dinâmico -->
@yield('content')

<div class="clear"></div>

<footer class="footer">
    <div class="container text-center">

        <p class="text-footer"> Copyright &copy; Laramusic - Todos os direitos reservados <?php echo date("Y")?> <br/>
            CNPJ: 00.000.000/0001-00 - contato@laramusic.com.br</p>

        <div class="social">
            <a href="#">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>

            <a href="#">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>

            <a href="#">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>

    </div> <!-- End Container-->
</footer> <!-- End Footer-->

<!-- Bootstrap-->
<script src="{{url('assets/all/js/bootstrap.min.js')}}"></script>

@stack('scripts-footer')
</body>
</html>