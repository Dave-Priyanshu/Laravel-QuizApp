<x-userLayout>
    @slot('title')
        Questions for {{ $category->name }}
    @endslot

    <div class="container mx-auto p-8 mt-10 max-w-7xl">
        <h1 class="text-3xl font-bold text-blue-800 mb-8 text-center">Questions for {{ $category->name }}</h1>

        @if ($questions->isNotEmpty())
            <form action="{{ route('users.panel.storeAnswers', ['categoryId' => $category->id]) }}" method="POST">
                @csrf

                <div class="space-y-6">
                    @foreach ($questions as $question)
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all">
                            <p class="text-lg font-semibold text-gray-800 mb-4">Q: {{ $question->question_text }}</p>
                            <div class="space-y-3">
                                @foreach ($question->answers as $answer)
                                    <label class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition-all">
                                        <input type="radio" name="question[{{ $question->id }}]" value="{{ $answer->id }}" class="form-radio text-blue-600 w-5 h-5">
                                        <span class="text-gray-700 text-sm">{{ $answer->answer_text }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Deselect Button for the whole question -->
                            <div class="text-left mt-4 font-bold">
                                <button type="button" class="flex items-center text-blue-500 text-sm hover:text-blue-700" onclick="deselectAnswer('{{ $question->id }}')">
                                    <!-- Cancel Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Deselect Answer
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    {{ $questions->links() }}
                </div>

                <div class="text-center mt-8">
                    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300 text-lg">
                        Submit Quiz
                    </button>
                </div>
            </form>
        @else
            <p class="text-lg text-gray-600 text-center mt-10">No questions are available for this category at the moment. Please check back later.</p>
        @endif
    </div>

    <script>
        function deselectAnswer(questionId) {
            // Deselect the selected radio button for the given question
            const radioButtons = document.querySelectorAll(`input[name="question[${questionId}]"]`);
            radioButtons.forEach(button => {
                button.checked = false;
            });
        }
    </script>
</x-userLayout>
