@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Olá {{Auth::user()->name}}, você está logado como {{Auth::user()->role->nome}}!
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('logout') }}" class="btn btn-danger"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        Sair
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection
