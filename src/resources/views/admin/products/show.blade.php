<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Информация о товаре
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Информация о товаре</h1>

            <a href="{{ route('admin.products.index') }}"
               class="text-blue-600 hover:underline">
                Назад к товарам
            </a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">

            @if ($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-48 h-48 object-cover rounded-md mb-6">
            @else
                <p class="text-gray-400 mb-6">Изображение отсутствует</p>
            @endif

            <h2 class="text-xl font-bold mb-4">
                {{ $product->name }}
            </h2>

            <p><strong>Категория:</strong>
                {{ $product->category?->name ?? 'Без категории' }}
            </p>

            <p><strong>Описание:</strong>
                {{ $product->description ?? 'Нет описания' }}
            </p>

            <p><strong>Цена:</strong>
                {{ number_format((float) $product->price, 2, '.', ' ') }} Р
            </p>

            <p><strong>Количество на складе:</strong>
                {{ $product->stock }}
            </p>

            <p><strong>Статус:</strong>
                {{ $product->status }}
            </p>

            <a href="{{ route('admin.products.edit', $product) }}"
               class="inline-block mt-6 bg-blue-600 text-white px-4 py-2 rounded">
                Редактировать товар
            </a>

        </div>
    </div>
</x-app-layout>