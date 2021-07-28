<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <title>{{$titulo or 'Login Laramusic'}}</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Fonts -->
        <link rel="stylesheet" href="{{url('assets/painel/font-awesome/css/font-awesome.min.css')}}">

        <!-- CSS -->
        <link rel="stylesheet" href="{{url('assets/painel/css/laramusic-painel.css')}}">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{url('assets/painel/imgs/favicon-laramusic.png')}}">
    </head>
    <body>
    <div class="caixa">
        <div class="login">

            <div class="login-header">
                <img src="{{url('assets/painel/imgs/laramusic-branca.png')}}" alt="LaraMusic" class="logo-login">
            </div>

            <div class="container">
                @yield('content-form')
            </div>
        </div>
    </div>
    </body>
</html>