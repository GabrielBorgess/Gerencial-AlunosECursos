<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Aluno
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded p-3">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('alunos.update', $aluno) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula</label>
                        <input type="text" name="matricula" id="matricula"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('matricula', $aluno->matricula) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" id="nome"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('nome', $aluno->nome) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
                        <select name="curso_id" id="curso_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Selecione um curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}"
                                    @selected(old('curso_id', $aluno->curso_id) == $curso->id)>
                                    {{ $curso->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                        <input type="text" name="cep" id="cep"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('cep', $aluno->cep) }}" maxlength="9" required>
                    </div>

                    <div class="mb-4">
                        <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="endereco" id="endereco"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('endereco', $aluno->endereco) }}" required>
                    </div>

                    <div class="flex justify-end space-x-2 items-center">
                        <a href="{{ route('alunos.index') }}"
                            class="text-gray-600 hover:underline">Cancelar</a>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
