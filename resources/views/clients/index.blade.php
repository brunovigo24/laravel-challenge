@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Cadastro de Clientes</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-dark mb-3">
            <i class="fas fa-plus"></i> Novo Cliente
        </a>

        <div class="input-group mb-3" style="max-width: 400px;">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            
            <input type="text" id="search" class="form-control" placeholder="Pesquisar por nome ou email...">
        </div>

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

        <table class="table table-bordered custom-rounded">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="clientTable">
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td class="text-center">
                            <a href="{{ route('clients.edit', ['client'=> $client->id]) }}" class="btn btn-outline-secondary btn-sm" title="Editar Cliente">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir Cliente">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#clientTable tr');

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection