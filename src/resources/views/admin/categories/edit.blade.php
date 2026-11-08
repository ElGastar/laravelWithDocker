
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать категорию
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name">Название</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $category->name) }}"
                            required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description">Описание</label>
                        <textarea
                            id="description"
                            name="description"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status">Статус</label>
                        <select
                            id="status"
                            name="status"
                            required
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        >
                            <option value="active" @selected(old('status', $category->status) === 'active')>
                                Активная
                            </option>
                            <option value="inactive" @selected(old('status', $category->status) === 'inactive')>
                                Неактивная
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-gray-800 text-white rounded-md"
                    >
                        Обновить
                    </button>

                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="ml-3 text-gray-600"
                    >
                        Отмена
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
```