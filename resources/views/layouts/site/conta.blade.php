@extends('layouts.app')

@section('content')
    <div class="well">
        <form class="form-horizontal">
            <fieldset>
                <legend>Meus Dados</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Nome</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Nome" value="{{Auth::user()->name}}" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">E-mail</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" value="{{Auth::user()->password}}" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPerfil" class="col-lg-2 control-label">Perfil</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputPerfil" placeholder="Perfil" value="{{Auth::user()->role->nome}}" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputDoacao" class="col-lg-2 control-label">Ativar Doação</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputDoacao" placeholder="Doação" value="Apenas Aprovado" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputHeroPoints" class="col-lg-2 control-label">Hero Points</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputHeroPoints" placeholder="Hero Points" value="23550" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputCriadoEm" class="col-lg-2 control-label">Data do Cadastro</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputCriadoEm" placeholder="Data do Cadastro" value="{{Auth::user()->created_at}}" >
                    </div>
                </div>

            </fieldset>
        </form>


    </div>
@endsection
