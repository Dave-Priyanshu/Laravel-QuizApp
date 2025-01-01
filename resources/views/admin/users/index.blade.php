<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">User Management</h1>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 text-green-800 rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-lg shadow-md bg-white">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-medium">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4 {{ $user->role === 'admin' ? 'font-bold' : '' }}">{{ $user->name }}</td>
                        <td class="px-6 py-4 {{ $user->role === 'admin' ? 'font-bold' : '' }}">{{ $user->email }}</td>
                        <td class="px-6 py-4 capitalize text-center">
                            <span class="px-2 py-1 rounded {{ $user->role === 'admin' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <!-- Toggle Admin Button -->
                            <form action="{{ route('admin.toggleAdmin', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-1 text-xs font-medium text-white rounded 
                                    {{ $user->role === 'admin' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }}">
                                    {{ $user->role === 'admin' ? 'Remove Admin' : 'Make Admin' }}
                                </button>
                            </form>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.users.edit', $user) }}" 
                                class="px-3 py-1 text-xs font-medium text-white bg-blue-500 hover:bg-blue-600 rounded">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 text-xs font-medium text-white bg-red-500 hover:bg-red-600 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $users->links() }}
    </div>
</x-adminLayout>
