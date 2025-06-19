<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alunos
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded p-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filtros --}}
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <input type="text" name="matricula" value="{{ request('matricula') }}" placeholder="Matrícula"
                    class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                <input type="text" name="nome" value="{{ request('nome') }}" placeholder="Nome"
                    class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                <select name="curso_id" class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                    <option value="">Todos os Cursos</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(request('curso_id') == $curso->id)>
                            {{ $curso->nome }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar</button>
            </form>

            <div class="flex justify-end mb-4">
                <a href="{{ route('alunos.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Novo Aluno
                </a>
            </div>

            {{-- Tabela --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Matrícula</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">CEP</th>
                            <th class="px-4 py-2 text-left">Endereço</th>
                            <th class="px-4 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($alunos as $aluno)
                            <tr>
                                <td class="px-4 py-2">{{ $aluno->matricula }}</td>
                                <td class="px-4 py-2">{{ $aluno->nome }}</td>
                                <td class="px-4 py-2">{{ $aluno->curso->nome }}</td>
                                <td class="px-4 py-2">{{ $aluno->cep }}</td>
                                <td class="px-4 py-2">{{ $aluno->endereco }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('alunos.edit', $aluno) }}"
                                        class="text-blue-600 hover:underline">Editar</a>

                                    <form method="POST" action="{{ route('alunos.destroy', $aluno) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Excluir aluno?')"
                                            class="text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Nenhum aluno encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $alunos->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
