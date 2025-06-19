<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cursos
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded p-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <input type="text" name="codigo" value="{{ request('codigo') }}" placeholder="Código"
                        class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                    <input type="text" name="nome" value="{{ request('nome') }}" placeholder="Nome"
                        class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar</button>

                    <a href="{{ route('cursos.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-md text-center hover:bg-green-700">Novo Curso</a>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Código</th>
                                <th class="px-4 py-2 text-left">Nome</th>
                                <th class="px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cursos as $curso)
                                <tr>
                                    <td class="px-4 py-2">{{ $curso->codigo }}</td>
                                    <td class="px-4 py-2">{{ $curso->nome }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('cursos.edit', $curso) }}"
                                            class="text-blue-600 hover:underline">Editar</a>

                                        <form method="POST" action="{{ route('cursos.destroy', $curso) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Excluir curso?')"
                                                class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($cursos->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">Nenhum curso encontrado.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $cursos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>