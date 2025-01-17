<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuariosRequest;
use App\Http\Requests\UpdateUsuariosRequest;
use App\Http\Requests\UsuariosLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usuarios.login');
    }

    public function login(UsuariosLoginRequest $request)
    {
        if(Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();
            return redirect()->route('clientes.index');
        }

        return back()->withInput()->withErrors([
            'message' => 'Usuário ou senha inválidos',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuariosRequest $request)
    {
        DB::beginTransaction();

        try {

            $user           = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();

            return redirect()->route('clientes.index')->with('message', 'Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('clientes.index')->withErrors([
                'message' => 'Falha ao cadastrar usuário. Mensagem técnica: ' . $th->getMessage(),
            ]);;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('usuarios.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuariosRequest $request, User $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuarios)
    {
        //
    }
}
