```blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Добавить категорию
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">
                            Название
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">
                            Описание
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">
                            Статус
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >
                            <option value="active" @selected(old('status', 'active') === 'active')>
                                Активная
                            </option>
                            <option value="inactive" @selected(old('status') === 'inactive')>
                                Неактивная
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                    >
                        Сохранить
                    </button>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="ml-3 text-gray-600 hover:text-gray-900"
                    >
                        Отмена
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
```