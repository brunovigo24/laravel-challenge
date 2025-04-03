@extends('layouts.app')

@section('content')
<x-auth-layout>
    <h4 class="text-left mb-4"><strong>{{ __('Redefinir Senha') }}</strong></h4>
    <h6 class="mb-4 text-muted" style="font-size: 0.9rem;">Digite seu e-mail para receber o link de redefinição de senha.</h6>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label"><strong>{{ __('E-mail') }}</strong></label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="seu@email.com">
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send"></i> {{ __('Enviar Link de Redefinição') }}
            </button>
        </div>
    </form>
</x-auth-layout>
@endsection
