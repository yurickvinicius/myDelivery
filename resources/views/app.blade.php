<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">

        <title>My Pizzas</title>

        <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">

        <!-- Fonts -->
        <!--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="{{{ asset('css/pizzeria.css') }}}" rel="stylesheet">

    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">MyDelivery</a>
                </div>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav">

                        <li><a href="{{ route('admin.drinks.index') }}">Opcionais</a></li>
                        <li><a href="{{ route('admin.deliverymeans.index') }}">Forma de Entrega</a></li>
                        <li><a href="{{ route('orders.index') }}"><span style="margin-left: 5px" class="badgePersonAlert pull-right">{{ @$totalOrders }}</span>Pedidos</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Pizzas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.edges.index') }}">Bordas</a></li>
                                <li><a href="{{ route('admin.flavors.index') }}">Sabores</a></li>
                                <li><a href="{{ route('admin.sizes.index') }}">Tamanhos</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Relatórios <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.reports.index') }}">Pedidos</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('admin.users.index') }}">Usuarios</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if(auth()->guest())
                        @if(!Request::is('auth/login'))
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        @endif
                        @if(!Request::is('auth/register'))
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                        @endif
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Perfil</a></li>
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @include('template.partials._message_success')
        @include('template.partials._message_info')
        @include('errors._check')
        @yield('content')

        <!-- Scripts -->
        <!---<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--->
        <!---<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>--->

        <script src="{{{ asset('js/jquery.min.js') }}}"></script>
        <script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>
        <script src="{{{ asset('js/jqueryMaskMoney.js') }}}"></script>
        <script src="{{{ asset('js/orders.js') }}}"></script>

        <!-- Necessario grafico pizza -->
        <script src="{{{ asset('js/loader.js') }}}"></script>
        <script src="{{{ asset('js/graficoPizza.js') }}}"></script>

        <script src="{{{ asset('js/jquery.mask.min.js') }}}"></script>
        <script src="{{{ asset('js/my_masks.js') }}}"></script>
        <script src="{{{ asset('js/validate_order.js') }}}"></script>
        <script src="{{{ asset('/js/showOrder.js') }}}"></script>

        <!--- Calendario no mozzila--->
        <!---<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
        <script>
          webshims.setOptions('waitReady', false);
          webshims.setOptions('forms-ext', {types: 'date'});
          webshims.polyfill('forms forms-ext');
        </script>--->
        <!------>

    </body>
</html>
