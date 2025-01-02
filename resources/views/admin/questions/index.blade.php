<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Manage Questions</h1>
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.questions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Question</a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left px-4 py-2 border-r font-medium text-gray-700">ID</th>
                        <th class="text-left px-4 py-2 border-r font-medium text-gray-700">Category</th>
                        <th class="text-left px-4 py-2 border-r font-medium text-gray-700">Type</th>
                        <th class="text-left px-4 py-2 border-r font-medium text-gray-700">Question</th>
                        <th class="text-left px-4 py-2 font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border-r text-gray-600">{{ $question->id }}</td>
                            <td class="px-4 py-2 border-r text-gray-600">{{ $question->category->name }}</td>
                            <td class="px-4 py-2 border-r text-gray-600">{{ $question->question_type }}</td>
                            <td class="px-4 py-2 border-r text-gray-600">{{ $question->question_text }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('admin.questions.edit', $question->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

       <div>
        {{ $questions->links() }}
    </div>
</x-adminLayout>
