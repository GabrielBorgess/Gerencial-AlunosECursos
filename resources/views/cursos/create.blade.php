<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novo Curso') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-md mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 font-medium text-red-600 dark:text-red-400">
                        {{ __('Erros no formulário:') }}
                        <ul>
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('cursos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="codigo" :value="'Código'" class="text-gray-800 dark:text-white"/>
                        <x-text-input id="codigo" class="block mt-1 w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700" type="text" name="codigo" :value="old('codigo')" required autofocus />
                        <x-input-error :messages="$errors->get('codigo')" class="mt-2 text-red-600 dark:text-red-400" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nome" :value="'Nome'" class="text-gray-800 dark:text-white"/>
                        <x-text-input id="nome" class="block mt-1 w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-gray-300 dark:border-gray-700" type="text" name="nome" :value="old('nome')" required />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2 text-red-600 dark:text-red-400" />
                    </div>

                    <div class="flex flex-wrap gap-4 justify-end">
                        <x-primary-button
                            type="button"
                            onclick="window.location='{{ route('cursos.index') }}'"
                            class="bg-red-600 hover:bg-red-700 text-white mr-2"
                        >
                            Cancelar
                        </x-primary-button>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white">
                            {{ __('Salvar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

