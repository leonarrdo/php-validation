<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Cliente</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Edição de Cliente</h2>

        @if ($errors->has('message'))
            <div class="mb-4 text-red-500">
                <p class="text-xs mt-2">{{ $errors->first('message') }}</p>
            </div>
        @endif

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-600">Nome</label>
                <input type="text" id="nome" name="nome" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nome', $cliente->nome) }}" required>
                @error('nome')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sobrenome" class="block text-sm font-medium text-gray-600">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('sobrenome', $cliente->sobrenome) }}" required>
                @error('sobrenome')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $cliente->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="idade" class="block text-sm font-medium text-gray-600">Idade</label>
                <input type="text" id="idade" name="idade" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('idade', $cliente->idade) }}" required>
                @error('idade')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ativo" class="block text-sm font-medium text-gray-600">Ativo</label>
                <input type="checkbox" id="ativo" name="ativo" class="mt-2" {{ $cliente->ativo ? 'checked' : '' }}>
                @error('ativo')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
</body>
</html>
