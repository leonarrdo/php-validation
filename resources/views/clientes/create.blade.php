<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Cadastro de Cliente</h2>


        <div class="flex justify-center mb-6">
            <a href="{{ route('clientes.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Listagem de Clientes
            </a>
        </div>

        @if ($errors->has('message'))
            <div class="mb-4 text-red-500">
                <p class="text-xs mt-2">{{ $errors->first('message') }}</p>
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-600">Nome</label>
                <input type="text" id="nome" name="nome" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nome') }}" required>
                @error('nome')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sobrenome" class="block text-sm font-medium text-gray-600">Sobrenome</label>
                <input type="text" id="sobrenome" name="sobrenome" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('sobrenome') }}" required>
                @error('sobrenome')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="idade" class="block text-sm font-medium text-gray-600">Idade</label>
                <input type="text" id="idade" name="idade" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('idade') }}" required>
                @error('idade')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mb-6">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>
</body>
</html>
