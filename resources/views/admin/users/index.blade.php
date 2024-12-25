<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Registered Users</h1>
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table id="usersTable" class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left px-4 py-2 border-r">ID</th>
                    <th class="text-left px-4 py-2 border-r">Name</th>
                    <th class="text-left px-4 py-2 border-r">Email</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b">
                    <td class="px-4 py-2 border-r">{{ $user->id }}</td>
                    <td class="px-4 py-2 border-r">{{ $user->name }}</td>
                    <td class="px-4 py-2 border-r">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <!-- Delete Button -->
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });
    </script>
    @endpush
</x-adminLayout>
