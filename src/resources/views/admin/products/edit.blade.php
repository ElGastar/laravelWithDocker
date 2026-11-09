```blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование товара
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Редактировать: {{ $product->name }}
                </h3>

                <form
                    method="POST"
                    action="{{ route('admin.products.update', $product) }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    {{-- Название --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Название товара
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required
                        >

                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Описание --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Описание товара
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Категория --}}
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">
                            Категория
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required
                        >
                            <option value="">Выберите категорию</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Цена --}}
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">
                            Цена товара
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $product->price) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required
                        >

                        @error('price')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Остаток на складе --}}
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700">
                            Количество на складе
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            min="0"
                            step="1"
                            value="{{ old('stock', $product->stock) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required
                        >

                        @error('stock')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Статус --}}
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Статус товара
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required
                        >
                            <option
                                value="active"
                                {{ old('status', $product->status) == 'active' ? 'selected' : '' }}
                            >
                                Активный
                            </option>

                            <option
                                value="inactive"
                                {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}
                            >
                                Неактивный
                            </option>
                        </select>

                        @error('status')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Текущее изображение --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Текущее изображение
                        </label>

                        @if ($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-32 h-32 object-cover rounded-md"
                            >
                        @else
                            <p class="text-gray-400">Изображение отсутствует</p>
                        @endif
                    </div>

                    {{-- Новое изображение --}}
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Загрузить новое изображение
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-700"
                        >

                        @error('image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Кнопки --}}
                    <div class="flex items-center gap-4 mt-6">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Сохранить изменения
                        </button>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Назад
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
```