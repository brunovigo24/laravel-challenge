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
                            <form action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="Excluir Cliente">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                timer: 5000,
                showConfirmButton: false
            });
        @endif

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

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter esta ação!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection