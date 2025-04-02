<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf_cnpj',
        'cep',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'phone',
        'email'
    ];
}
