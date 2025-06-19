<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Alunos
            </h2>
            <div>
                <a href="{{ route('alunos.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-md text-center hover:bg-green-700">
                    Novo Aluno
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">

            @if(session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded p-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filtros --}}
            <form method="GET" class="flex gap-4 mb-6 flex-wrap justify-center sm:justify-between">
                <div class="flex flex-wrap gap-4 bg-red justify-center sm:justify-between">
                    <input type="text" name="matricula" value="{{ request('matricula') }}" placeholder="Matrícula"
                        class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                    <input type="text" name="nome" value="{{ request('nome') }}" placeholder="Nome"
                        class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                    <select name="curso_id" class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        <option value="">Todos os Cursos</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" @selected(request('curso_id') == $curso->id)>
                                {{ $curso->nome }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar
                    </button>
                </div>

                    <div class="flex items-center gap-4">
                        <label for="por_pagina" class="text-sm text-gray-700 dark:text-gray-300">Por página:</label>
                        <select name="por_pagina" id="por_pagina" onchange="this.form.submit()"
                            class="w-20 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                            @foreach([5, 10, 20, 50] as $opcao)
                                <option value="{{ $opcao }}" @selected(request('por_pagina', 5) == $opcao)>
                                    {{ $opcao }}
                                </option>
                            @endforeach
                    </select>
                    </div>
            </form>

            {{-- Tabela --}}
            <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-200">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">Matrícula</th>
                            <th class="px-4 py-3 text-left">Nome</th>
                            <th class="px-4 py-3 text-left">Curso</th>
                            <th class="px-4 py-3 text-left">CEP</th>
                            <th class="px-4 py-3 text-left">Endereço</th>
                            <th class="px-4 py-3 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($alunos as $aluno)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">{{ $aluno->matricula }}</td>
                                <td class="px-4 py-3">{{ $aluno->nome }}</td>
                                <td class="px-4 py-3">{{ $aluno->curso->nome }}</td>
                                <td class="px-4 py-3">{{ $aluno->cep }}</td>
                                <td class="px-4 py-3">{{ $aluno->endereco }}</td>
                                <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('alunos.edit', $aluno) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('alunos.destroy', $aluno) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Excluir aluno?')" class="text-red-600 hover:underline">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Nenhum aluno encontrado.</td>
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
