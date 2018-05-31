<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>EcoleDirecte - @yield('title', 'Client alternatif')</title>

    <meta name="robots" content="noindex, nofollow">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="{{ url('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/bootstrap@4/dist/css/bootstrap.min.css,npm/animate.css@3">
    @yield('css')
    <link rel="stylesheet" href="{{ url('assets/css/theme.css') }}">
</head>
<body>
    <header id="header">
        <div class="container">
            <div class="navbar-backdrop">
                <div class="navbar">
                    <div class="navbar-left">
                        <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                        <a href="{{ url('/') }}" class="logo"><img src="https://www.ecoledirecte.com/images/logoEcoleDirecte.ea20cfb1.png" style="margin-top: -10px;"></a>
                        <nav class="nav">
                            <ul>
                                <li>
                                    <a href="{{ url('/') }}">Accueil</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nav navbar-right">
                        <ul>
                            <li class="hidden-xs-down"><a href="{{ url('login') }}">Connexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <script src="{{ url('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('assets/plugins/popper/popper.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('js')
    <script src="{{ url('assets/js/app.min.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114367988-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-114367988-3');
    </script>
</body>
</html>
