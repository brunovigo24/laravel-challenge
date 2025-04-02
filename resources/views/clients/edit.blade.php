@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Novo Cliente</h2>

        @if (session()->  has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->  has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
            </div>

            <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="{{ $client->cpf_cnpj }}" required>
            </div>

            <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" value="{{ $client->cep }}" required>
            </div>

            <div class="mb-3">
            <label for="street" class="form-label">Rua</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ $client->street }}" required>
            </div>

            <div class="mb-3">
            <label for="number" class="form-label">Número</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $client->number }}" required>
            </div>

            <div class="mb-3">
            <label for="neighborhood" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ $client->neighborhood }}" required>
            </div>

            <div class="mb-3">
            <label for="city" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $client->city }}" required>
            </div>

            <div class="mb-3">
            <label for="state" class="form-label">Estado</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ $client->state }}" required>
            </div>

            <div class="mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}" required>
            </div>

            <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>

    </div>

    <script>
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
    </script>
@endsection