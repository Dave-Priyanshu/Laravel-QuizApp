<x-userLayout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Multiple Choice Quiz</h2>

        @if (!empty($message))
            <p class="text-red-600">{{ $message }}</p>
        @else
            <form action="{{ route('quiz.submit') }}" method="POST">
                @csrf
                @foreach ($questions as $index => $question)
                    <div class="mb-6">
                        <h3 class="font-semibold">{{ $index + 1 }}. {{ $question->question_text }}</h3>
                        <div class="mt-2">
                            @foreach ($question->answers as $answer)
                                <label class="block">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="mr-2">
                                    {{ $answer->answer_text }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
             <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
            </form>
        @endif
    </div>
</x-userLayout>
