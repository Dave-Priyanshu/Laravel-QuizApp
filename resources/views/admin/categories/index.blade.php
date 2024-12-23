<x-adminLayout>
    <div class="container mx-auto p-8 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Categories</h1>

        @if (session('success'))
            <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
        @endif

        <div class="mb-6 text-right">
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                Add New Category
            </a>
        </div>

        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr class="bg-gray-50 text-left">
                    <th class="border border-gray-200 px-4 py-2 text-gray-600 font-medium">ID</th>
                    <th class="border border-gray-200 px-4 py-2 text-gray-600 font-medium">Name</th>
                    <th class="border border-gray-200 px-4 py-2 text-gray-600 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $category->id }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $category->name }}</td>
                        <td class="border border-gray-200 px-4 py-2 space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-adminLayout>
