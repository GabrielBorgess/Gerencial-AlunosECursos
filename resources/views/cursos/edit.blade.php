<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Curso
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900 border border-red-300 dark:border-red-700 rounded p-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cursos.update', $curso) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código</label>
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $curso->codigo) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring focus:ring-indigo-200" />
            </div>

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome', $curso->nome) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring focus:ring-indigo-200" />
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Atualizar</button>
                <a href="{{ route('cursos.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
