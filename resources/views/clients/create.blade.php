@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h2 class="mb-4">Cadastro de Cliente</h2>
        <p class="mb-4">Preencha os dados do cliente para cadastro no sistema.</p>

        <form action="{{ route('clients.store') }}" method="post" id="clientForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Documento</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="document_type" id="cpf" value="CPF" checked>
                        <label class="form-check-label" for="cpf">CPF</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="document_type" id="cnpj" value="CNPJ">
                        <label class="form-check-label" for="cnpj">CNPJ</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="000.000.000-00" required>
            </div>

            <h4 class="mt-4">Endereço</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="street" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Nome da rua" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="Número" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Bairro" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input class="form-control" id="state" name="state" required></input>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@exemplo.com" required>
                    <div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
                </div>
            </div>

            <button type="submit" class="btn btn-dark w-100">Cadastrar Cliente</button>
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