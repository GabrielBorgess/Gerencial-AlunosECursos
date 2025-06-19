<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Quantidade de Alunos por Curso
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <form method="GET" class="flex flex-wrap gap-4 mb-6 items-center justify-end">
                    <input
                        type="text"
                        name="busca"
                        value="{{ request('busca', $busca ?? '') }}"
                        placeholder="Pesquisar curso..."
                        class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 px-2 py-1"
                    />
                    <label for="por_pagina" class="text-sm text-gray-700 dark:text-gray-300">Por página:</label>
                    <select name="por_pagina" id="por_pagina" onchange="this.form.submit()"
                        class="w-20 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        @foreach([5, 10, 20, 50] as $opcao)
                            <option value="{{ $opcao }}" @selected(request('por_pagina', $porPagina ?? 10) == $opcao)>
                                {{ $opcao }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar
                    </button>
                 </form>
                <div class="overflow-x-auto rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left w-3/4">Curso</th>
                                <th class="px-4 py-3 text-left w-1/4">Quantidade de Alunos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($dados as $curso)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-4 py-3">{{ $curso->nome }}</td>
                                    <td class="px-4 py-3">{{ $curso->alunos_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 dark:text-gray-300">
                    {{ $dados->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
