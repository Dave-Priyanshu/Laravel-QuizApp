<x-adminLayout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Add New Question</h1>

        <form action="{{ route('admin.questions.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="question_text" class="block text-gray-700 font-bold mb-2">Question</label>
                <textarea name="question_text" id="question_text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" required></textarea>
            </div>

            <div id="answers-container" class="mb-4">
                <div class="flex items-center mb-2">
                    <input type="text" name="answers[0][answer_text]" placeholder="Answer Text" class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <label class="ml-2 text-gray-700 font-bold">
                        <input type="checkbox" name="answers[0][is_correct]" class="mr-2"> Correct
                    </label>
                </div>
            </div>

            <button type="button" id="add-answer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Add Another Answer</button>

            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save Question</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById('add-answer').addEventListener('click', function() {
                const container = document.getElementById('answers-container');
                const index = container.children.length;
                const answerHTML = `
                    <div class="flex items-center mb-2">
                        <input type="text" name="answers[${index}][answer_text]" placeholder="Answer Text" class="shadow appearance-none border rounded w-3/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <label class="ml-2 text-gray-700 font-bold">
                            <input type="checkbox" name="answers[${index}][is_correct]" class="mr-2"> Correct
                        </label>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', answerHTML);
            });
        </script>
    @endpush
</x-adminLayout>