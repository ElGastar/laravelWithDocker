
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Категории
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-semibold">Список категорий</h3>

    <a
        href="{{ route('admin.categories.create') }}"
        class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
    >
        Создать категорию
    </a>
</div>
@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
        {{ session('success') }}
    </div>
@endif


                @if ($categories->isEmpty())
                    <p class="text-gray-600">Категорий пока нет.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Название</th>
                                <th class="px-4 py-2 text-left">Статус</th>
                                <th class="px-4 py-2 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-4 py-2">{{ $category->id }}</td>
                                    <td class="px-4 py-2">{{ $category->name }}</td>
                                    <td class="px-4 py-2">{{ $category->status }}</td>
                                    <td class="px-4 py-2">
    <a
        href="{{ route('admin.categories.edit', $category) }}"
        class="text-blue-600 hover:text-blue-800"
    >
        Редактировать
    </a>

<form
    method="POST"
    action="{{ route('admin.categories.destroy', $category) }}"
    onsubmit="return confirm('Вы действительно хотите удалить эту категорию?')"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="text-red-600 hover:text-red-800"
    >
        Удалить
    </button>
</form>

</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
