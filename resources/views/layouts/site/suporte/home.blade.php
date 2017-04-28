@extends('layouts.app')

@section('content')
<div class="well">

    <div class="row">
        <div class="col-md-4">
            <ul class="nav nav-pills">
                <li><a href="/site/suporte/novo">Novo Chamado</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select class="form-control" id="select">
                    <option>Categoria</option>
                    <option>Hack</option>
                    <option>Cash</option>
                    <option>Item</option>
                    <option>Denúncia</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 ">
            <div class="form-group">
                <select class="form-control" id="select">
                    <option>Status</option>
                    <option>Aberto</option>
                    <option>Fechado</option>
                </select>
            </div>
        </div>

    </div>

    <div class="panel">

        <table id="tabela_chamados" class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Data da Abertura</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr class="info">
                <td>3</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr class="success">
                <td>4</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr class="danger">
                <td>5</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr class="warning">
                <td>6</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            <tr class="active">
                <td>7</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
