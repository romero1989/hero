<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/site/home">Início</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Conta <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/site/conta">Meus Dados</a></li>
                        <li class="divider"></li>
                        <li><a href="/site/guild">Guild Mark</a></li>
                        <li class="divider"></li>
                        <li><a href="/site/suporte">Suporte</a></li>
                    </ul>
                </li>

                @if(Auth::user()->isAdmin())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administração <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Notícias</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Suporte</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Atualização</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Painel de Controle</a></li>
                        </ul>
                    </li>
                @endif


            </ul>

            <div class="navbar-form navbar-right">
                <a href="{{ route('logout') }}" class="btn btn-danger"
                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                    Sair
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>


    </div>
</nav>