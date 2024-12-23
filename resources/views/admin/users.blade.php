<x-adminLayout>
    <h1 class="text-2xl font-bold mb-4">All User List</h1>

    @if (session('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" id="success-message" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" id="error-message" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table id="usersTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Total Post</th>
                    <th>User Posts</th>
                    <th>Admin</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $user->created_at->format('M d, Y') }}</td> --}}
                        <td class="">{{ $user->posts->count() }}</td>
                        <td>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <a href="{{ url( $user->id . '/singlepost') }}">View Posts</a>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('admin.toggleAdmin', $user) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                </button>
                            </form>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('admin.user.destroy',$user->id) }}" method="POST" style="display:inline;onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();

            // Auto-hide success and error messages
            setTimeout(function() {
                $('#success-message, #error-message').fadeOut('slow');
            }, 3000); // 3000 milliseconds = 5 seconds
        
        });
        
    </script>
    @endpush
</x-adminLayout>