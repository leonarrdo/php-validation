<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Listagem de Clientes</h2>

        <div class="flex justify-center mb-6">
            <a href="{{ route('clientes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Cadastrar Novo Cliente
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse mx-auto">
                <thead>
                    <tr class="text-left bg-gray-100">
                        <th class="px-4 py-2">
                            <a href="{{ route('clientes.index', ['sortBy' => 'nome', 'order' => request()->get('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-600 hover:text-blue-800">Nome</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('clientes.index', ['sortBy' => 'email', 'order' => request()->get('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-600 hover:text-blue-800">Email</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('clientes.index', ['sortBy' => 'idade', 'order' => request()->get('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-600 hover:text-blue-800">Idade</a>
                        </th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $cliente->nome }}</td>
                            <td class="px-4 py-2">{{ $cliente->email }}</td>
                            <td class="px-4 py-2">{{ $cliente->idade }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-yellow-600 hover:text-yellow-800">Editar</a> |
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-6">
            <form method="GET" action="{{ route('clientes.index') }}" class="flex items-center">
                <label for="perPage" class="mr-2 text-sm text-gray-600">Itens por Página:</label>
                <select name="perPage" id="perPage" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                    <option value="10" {{ request()->get('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request()->get('perPage', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request()->get('perPage', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request()->get('perPage', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
        </div>

        <div class="flex justify-center items-center mt-6">
            {{ $clientes->appends(request()->all())->links() }}
        </div>
    </div>

</body>
</html>
