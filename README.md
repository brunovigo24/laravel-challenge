# Cadastro de Clientes

Este projeto é uma aplicação Laravel para cadastro e gerenciamento de clientes.

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/laravel-challenge.git
   cd cadastro-cliente
   ```

2. Instale as dependências do projeto:
  ```bash
  composer install
  ```
3. Gere a chave da aplicação:
``` bash
php artisan key:generate
```
4. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve 
   ou
   php -S 127.0.0.1:8000 -t public
   ```

5. Acesse a aplicação no navegador:
   ```
   http://localhost:8000
   ```

6. Faça login com o e-mail e senha:
   ```
   admin@gmail.com
   123456
   ```

> **Nota:** O projeto já está configurado para utilizar o banco de dados SQLite. Não é necessário configurar o `.env` ou executar migrações.

## Funcionalidades

- Cadastro, edição e exclusão de clientes.
- Pesquisa de clientes por nome ou email.
- Paginação de resultados.

## Boas Práticas Utilizadas

1. **Proteção contra CSRF**:
   - Todas as requisições POST, PUT e DELETE utilizam o token `@csrf` para proteger contra ataques de Cross-Site Request Forgery.

2. **Herança de Templates**:
   - O projeto utiliza herança de templates Blade para reaproveitar layouts e manter o código organizado. Exemplo: `@extends('layouts.app')`.

3. **Encapsulamento de Componentes**:
   - Componentes reutilizáveis, são encapsulados para facilitar a manutenção.

4. **Validação de Dados**:
   - Validação de email e outros campos é realizada no backend para garantir a integridade dos dados.

5. **Máscaras e Restrições de Input**:
   - Inputs como CPF/CNPJ e telefone aceitam apenas números, garantindo consistência nos dados.

6. **Uso de `var_dump` durante os testes**:
   - Durante o desenvolvimento, o uso de `var_dump` e outras ferramentas de debug foi empregado para identificar problemas.

7. **Confirmação de Ações**:
   - A exclusão de registros exige confirmação do usuário, utilizando o SweetAlert2 para uma melhor experiência.

8. **Pesquisa em Tempo Real**:
   - A funcionalidade de pesquisa utiliza JavaScript para filtrar os resultados dinamicamente.
