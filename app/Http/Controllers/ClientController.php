<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ViaCepService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private readonly Client $client;
    private readonly ViaCepService $viaCepService;

    public function __construct()
    {
        $this->client = new Client();
        $this->viaCepService = new ViaCepService();
    }

    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $created = $this->client->create([
            'name' => $request->name,
            'cpf_cnpj' => $request->cpf_cnpj,
            'cep' => $request->cep,
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        if ($created) {
            return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
        }
        return redirect()->back()->with('error', 'Erro ao cadastrar cliente!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    public function update(Request $request, string $id)
    {
        $updated = $this->client->where('id', $id)->update($request->except('_token', '_method'));
        if ($updated) {
            return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
        }
        return redirect()->back()->with('error', 'Erro ao atualizar cliente!');
    }

    public function destroy(string $id)
    {
        $deleted = $this->client->where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
        }
        return redirect()->back()->with('error', 'Erro ao excluir cliente!');
    }
}
