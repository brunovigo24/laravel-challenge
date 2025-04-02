@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Novo Cliente</h2>

        <form action="{{ route('clients.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" required>
            </div>

            <div class="mb-3">
                <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required>
            </div>

            <div class="mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>

            <div class="mb-3">
                <label for="street" class="form-label">Rua</label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Número</label>
                <input type="text" class="form-control" id="number" name="number" required>
            </div>

            <div class="mb-3">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
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