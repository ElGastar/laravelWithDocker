<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Товары
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Список Товаров</h3>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                        Создать товар
                    </a>
                </div>
                @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
                @endif


                @if ($products->isEmpty())
                <p class="text-gray-600">Товаров пока нет.</p>
                @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Фото</th>
                            <th class="px-4 py-2 text-left">Название</th>
                            <th class="px-4 py-2 text-left">Категория</th>
                            <th class="px-4 py-2 text-left">Цена</th>
                            <th class="px-4 py-2 text-left">Количество на складе</th>
                            <th class="px-4 py-2 text-left">Статус</th>
                            <th class="px-4 py-2 text-left">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $product->id }}</td>
                            <td class="px-4 py-2">
                                @if ($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover rounded-md">
                                @else
                                <span class="text-gray-400">Нет фото</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ $product->category?->name ?? "Без категории" }}</td>
                            <td class="px-4 py-2">{{ number_format((float) $product->price, 2, '.', ' ') }} Р</td>
                            <td class="px-4 py-2">{{ $product->stock }}</td>
                            <td class="px-4 py-2">{{ $product->status }}</td>
                            <td class="px-4 py-2">
                                <a
                                    href="{{ route('admin.products.edit', $product) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    Редактировать
                                </a>
                                <a href="{{ route('admin.products.show', $product) }}"
   class="text-green-600 hover:underline">
    Просмотр
</a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    onsubmit="return confirm('Вы действительно хотите удалить этот товар?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800">
                                        Удалить
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>