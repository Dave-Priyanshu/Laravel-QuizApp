<!-- resources/views/users/questions.blade.php -->
<x-userLayout>
    @slot('title')
        Questions for this Category
    @endslot

    <div class="container mx-auto p-10 mt-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-blue-800 mb-8 text-center">Questions for {{ $category->name }}</h1>

        <form action="" method="POST">
            @csrf

            <div class="space-y-8">
                @foreach ($questions as $question)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <p class="text-xl font-semibold text-gray-800 mb-4">{{ $question->text }}</p>
                        <div class="space-y-4">
                            <label class="flex items-center space-x-2">
                                {{-- <input type="radio" name="question[{{ $question->id }}]" value="{{ $option->id }}" class="form-radio text-blue-600"> --}}
                                
                            </label>
                            {{ $question->question_text }}
                            {{ $question->question_type }}
                            {{-- {{ $question->answers->answer_text }} --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300">
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>
</x-userLayout>
