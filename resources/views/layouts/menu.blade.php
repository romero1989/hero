@if (Auth::check())
    @include('layouts.site.menu')
@elseif (!Auth::check())
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">HOME</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/download">DOWNLOAD</a></li>
                    <li><a href="/donate">DONATE</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RANKING <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Ranking A</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Ranking B</a></li>
                        </ul>
                    </li>
                    <li><a href="/forum">FÓRUM</a></li>
                    <li><a href="/regras">REGRAS</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @include("auth.login-menu")
                </ul>
            </div>
        </div>
    </nav>

@endif



