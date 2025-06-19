<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Cursos
            </h2>
            <a href="{{ route('cursos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-center hover:bg-green-700">
                Novo Curso
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">

            @if(session('success'))
                <div class="mb-4 text-sm text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700 rounded p-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class=" dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <form method="GET" class="flex gap-4 mb-6 flex-wrap justify-center sm:justify-between">
                    <div class="flex gap-4 flex-wrap justify-center sm:justify-between">
                        <input type="text" name="codigo" value="{{ request('codigo') }}" placeholder="Código"
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                        <input type="text" name="nome" value="{{ request('nome') }}" placeholder="Nome"
                            class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar</button>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
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

                <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left w-1/4">Código</th>
                                <th class="px-4 py-3 text-left w-2/4">Nome</th>
                                <th class="px-4 py-3 w-1/4 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($cursos as $curso)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-4 py-3">{{ $curso->codigo }}</td>
                                    <td class="px-4 py-3">{{ $curso->nome }}</td>
                                    <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('cursos.edit', $curso) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:underline">
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('cursos.destroy', $curso) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Excluir curso?')"
                                                    class="text-red-600 dark:text-red-400 hover:underline">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01
                                                M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="mt-2 block">Nenhum curso encontrado.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 dark:text-gray-300">
                    {{ $cursos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>