@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Clientes</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Novo Cliente</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->cpf_cnpj }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            <a href="{{ route('clients.edit', ['client'=> $client->id]) }}" class="btn btn-info btn-sm">Editar</a>
                            <form action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection