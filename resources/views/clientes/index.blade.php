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
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Listagem de Clientes</h2>
        <p class="text-l font-semibold text-center text-gray-700 mb-4">Bem-vindo, {{ Auth::user()->name }}!</p>

        <div class="flex justify-center mb-6">
            <div class="flex justify-center p-4 mb-3">
                <a href="{{ route('clientes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cadastrar Novo Cliente
                </a>
            </div>
            <div class="flex justify-center p-4 mb-3">
                <a href="{{ route('usuarios.logout') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Encerrar Sessão
                </a>
            </div>
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
                        <th class="px-4 py-2">
                            <a href="{{ route('clientes.index', ['sortBy' => 'ativo', 'order' => request()->get('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-600 hover:text-blue-800">Ativo</a>
                        </th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-t">
                            <td class="px-4 py-2 truncate" style="max-width: 200px;">{{ $cliente->nome }}</td>
                            <td class="px-4 py-2 truncate" style="max-width: 200px;">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 text-center">{{ $cliente->idade }}</td>
                            <td class="px-4 py-2 text-center">{{ $cliente->ativo == 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-blue-600 hover:text-blue-800">Editar</a> |
                                <form action="{{ route('clientes.inativar', $cliente->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800">{{ $cliente->ativo == 1 ? 'Inativar' : 'Ativar' }}</button> |
                                </form>
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
                    <option value="20" {{ request()->get('perPage', 10) == 20 ? 'selected' : '' }}>20</option>
                    <option value="30" {{ request()->get('perPage', 10) == 30 ? 'selected' : '' }}>30</option>
                    <option value="50" {{ request()->get('perPage', 10) == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
        </div>

        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Exibindo {{ $clientes->firstItem() }}-{{ $clientes->lastItem() }} de {{ $clientes->total() }} clientes
            </div>

            <div class="flex items-center space-x-2">
                @if($clientes->onFirstPage())
                    <span class="px-3 py-2 bg-gray-300 text-gray-500 rounded cursor-not-allowed">Anterior</span>
                @else
                    <a href="{{ $clientes->appends(['perPage' => request()->get('perPage', 10)])->previousPageUrl() }}" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Anterior</a>
                @endif

                @foreach(range(1, $clientes->lastPage()) as $page)
                    @if($page == $clientes->currentPage())
                        <span class="px-3 py-2 bg-blue-500 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $clientes->appends(['perPage' => request()->get('perPage', 10)])->url($page) }}" class="px-3 py-2 bg-gray-200 text-blue-600 rounded hover:bg-blue-300">{{ $page }}</a>
                    @endif
                @endforeach

                @if($clientes->hasMorePages())
                    <a href="{{ $clientes->appends(['perPage' => request()->get('perPage', 10)])->nextPageUrl() }}" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Próxima</a>
                @else
                    <span class="px-3 py-2 bg-gray-300 text-gray-500 rounded cursor-not-allowed">Próxima</span>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
