<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $sortBy = $request->get('sortBy', 'nome');
        $order = $request->get('order', 'asc');
    
        $clientes = Cliente::orderBy($sortBy, $order)->paginate($perPage);
    
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        DB::beginTransaction();

        try {

            $cliente            = new Cliente();
            $cliente->nome      = $request->nome;
            $cliente->sobrenome = $request->sobrenome;
            $cliente->email     = $request->email;
            $cliente->idade     = $request->idade;
            $cliente->save();

            DB::commit();

            return redirect()->route('clientes.index')->with('message', 'Cliente cadastrado com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('clientes.create')->withErrors([
                'message' => 'Falha ao cadastrar cliente. Mensagem técnica: ' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        DB::beginTransaction();

        try {

            $cliente->nome      = $request->nome;
            $cliente->sobrenome = $request->sobrenome;
            $cliente->email     = $request->email;
            $cliente->idade     = $request->idade;
            $cliente->ativo     = $request->has('ativo') ? true : false;
            $cliente->save();

            DB::commit();

            return redirect()->route('clientes.index')->with('message', 'Cliente atualizado com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('clientes.edit', $cliente)->withErrors([
                'message' => 'Falha ao atualizar cliente. Mensagem técnica: ' . $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
