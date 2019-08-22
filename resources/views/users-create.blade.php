@extends('master')

@section('title')
    Nofaro - novo usuário
@stop

@section('content')
    <div>        
        <div class="col-sm-12">
            <h3>Cadastro de Usuário</h3>
        </div>
        <form action="{{ route('users.store') }}" method="POST" >
            {{ csrf_field() }}

            <div class="form-group input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon-name">Nome</span>
                </div>
                <input type="text" class="form-control" aria-describedby="basic-addon-name" name="name" required>
            </div>

            <div class="form-group input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon-email">Email</span>
                </div>
                <input type="email" class="form-control" aria-describedby="basic-addon-email" name="mail"required>
            </div>            

            <div class="form-row">
                <div class="form-group input-group col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon-ddd">DDD</span>
                    </div>
                    <input type="number" class="form-control" aria-describedby="basic-addon-ddd" name="ddd" max="99">
                </div>
                <div class="form-group input-group col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon-phone">Telefone</span>
                    </div>
                    <input type="number" class="form-control" aria-describedby="basic-addon-phone" name="phone" max="999999999">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="material-icons small">done</i>
                Salvar
            </button>
            <a href="{{ route('users.list') }}" class="btn btn-secondary">
                <i class="material-icons small">navigate_before</i>
                Voltar a listagem
            </a>
        </form>
    </div>
@stop