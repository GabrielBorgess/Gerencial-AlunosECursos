<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Alunos por Curso (Ordem Alfabética)
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @foreach($cursos as $curso)
                <div class="bg-white shadow-sm rounded p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">{{ $curso->nome }}</h3>
                    @if($curso->alunos->count())
                        <ul class="list-disc list-inside text-gray-800">
                            @foreach($curso->alunos as $aluno)
                                <li>{{ $aluno->nome }} ({{ $aluno->matricula }})</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Nenhum aluno neste curso.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
