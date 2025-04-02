<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function buscarEndereco(string $cep): ?array
    {
        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->failed() || isset($response['erro'])) {
                return null;
            }

            return $response->json();
            
        } catch (\Exception $e) {
            return null;
        }
    }
}
