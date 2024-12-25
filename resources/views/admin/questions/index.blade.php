<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Questions</h1>
        
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-4">Add New Question</a>

        <table id="questionsTable" class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left px-4 py-2 border-r">ID</th>
                    <th class="text-left px-4 py-2 border-r">Category</th>
                    <th class="text-left px-4 py-2 border-r">Question</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr class="border-b">
                    <td class="px-4 py-2 border-r">{{ $question->id }}</td>
                    <td class="px-4 py-2 border-r">{{ $question->category->name }}</td>
                    <td class="px-4 py-2 border-r">{{ $question->question_text }}</td>
                    <td class="px-4 py-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this question?');">
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
</x-adminLayout>
