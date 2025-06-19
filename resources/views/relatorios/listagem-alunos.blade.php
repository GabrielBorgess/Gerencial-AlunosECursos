<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista de Alunos por Curso (Ordem Alfabética)
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 p-4 flex flex-col gap-4">
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
                            @foreach([2, 5, 10, 20] as $opcao)
                                <option value="{{ $opcao }}" @selected(request('por_pagina', $porPagina ?? 5) == $opcao)>
                                    {{ $opcao }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filtrar</button>
                    </div>
                 </form>
                @forelse($cursos as $curso)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 shadow-sm border border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-3">{{ $curso->nome }}</h3>
                        @if($curso->alunos->count())
                            <ul class="list-disc list-inside text-gray-800 dark:text-gray-100">
                                @foreach($curso->alunos as $aluno)
                                    <li>{{ $aluno->nome }} <span class="text-xs text-gray-500">({{ $aluno->matricula }})</span></li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">Nenhum aluno neste curso.</p>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01
                                M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="mt-2 block">Nenhum curso encontrado.</span>
                    </div>
                @endforelse
                <div class="mt-4 dark:text-gray-300">
                    {{ $cursos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
