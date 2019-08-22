@extends('master')

@section('title')
    Nofaro - Listagem de usuários
@stop

@section('content')
    <div class="col-sm-12">
        <h3>Usuários</h3>
    </div>
    @if($users->count() > 0)
        <form action="{{ route('users.list') }}" method="GET" class="form-inline" style="background-color: #343a40; padding: 10px; border-radius: 5px;">
            <div class="form-group col-md-5">
                <input type="text" class="form-control-plaintext" name="name" value="{{ isset($name) ? $name : null }}" placeholder="Busca por nome" style="background-color: lightgray; color: #fff; border-radius: 5px;">
            </div>
            <div class="form-group col-md-5">
                <input type="text" class="form-control-plaintext" name="mail" value="{{ isset($mail) ? $mail : null }}" placeholder="Busca por email" style="background-color: lightgray; color: #fff; border-radius: 5px;">
            </div>
            <button type="submit" class="btn btn-secondary col-md-2">Buscar</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>DDD</td>
                    <td>Telefone</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->mail }}</td>
                        <td>{{ $user->ddd }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('users.show', ['id' => $user->id]) }}" title="Editar registro" class="btn btn-secondary"><i class="material-icons small">edit</i>Editar</a>
                                <button title="Excluir registro" 
                                        class="btn btn-secondary js-user-delete" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}" 
                                        data-toggle="modal" 
                                        data-target="#modal-primary">
                                    <i class="material-icons small">delete</i>
                                    Excluir
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>
            <p>Nenhum usuário cadastrado</p>
        </div>
    @endif
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="material-icons small">add</i>Cadastrar novo Usuário</a>
@stop