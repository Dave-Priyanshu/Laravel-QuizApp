<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Edit User</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update User</button>
        </form>
    </div>
</x-adminLayout>
