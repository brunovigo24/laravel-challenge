@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/clients') }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h2 class="mb-4">Editar Cliente</h2>
        <p class="mb-4">Atualize os dados do cliente no sistema.</p>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="POST" id="clientForm">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
            </div>

            <!-- Removido o campo Tipo de Documento -->

            <div class="mb-3">
                <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{ $client->cpf_cnpj }}" required>
            </div>

            <h4 class="mt-4">Endereço</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="street" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ $client->street }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{ $client->number }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ $client->neighborhood }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $client->city }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input class="form-control" id="state" name="state" value="{{ $client->state }}" required></input>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" value="{{ $client->cep }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" required>
                    <div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
                </div>
            </div>

            <button type="submit" class="btn btn-dark w-100">Atualizar Cliente</button>
        </form>
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

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: '{{ session('error') }}',
                timer: 5000,
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

        document.getElementById('cep').addEventListener('blur', function () {
            fetch(`https://viacep.com.br/ws/${this.value}/json/`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('street').value = data.logradouro || '';
                    document.getElementById('neighborhood').value = data.bairro || '';
                    document.getElementById('city').value = data.localidade || '';
                    document.getElementById('state').value = data.uf || '';
                });
        });

        document.getElementById('clientForm').addEventListener('submit', function (event) {
            const emailField = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                event.preventDefault();
            } else {
                emailField.classList.remove('is-invalid');
            }
        });
    </script>
@endsection