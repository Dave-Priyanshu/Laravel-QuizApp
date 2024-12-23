<x-adminLayout>
    <div class="container mx-auto p-8 max-w-md bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">Add New Category</h1>

        @if(session('success'))
            <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <ul class="mb-4 text-red-600 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" placeholder="Enter category name" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                Add Category
            </button>
        </form>
    </div>
</x-adminLayout>
