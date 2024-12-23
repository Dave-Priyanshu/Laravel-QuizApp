<x-adminLayout>
    <div class="container mx-auto p-8 max-w-md bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Edit Category</h1>

        @if ($errors->any())
            <ul class="mb-4 text-red-600 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                Update Category
            </button>
        </form>
    </div>
</x-adminLayout>
