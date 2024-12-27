<!-- resources/views/users/home.blade.php -->
<x-userLayout>
    {{-- @slot('title')
        User Panel
    @endslot --}}

    <div class="container mx-auto p-10 mt-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-blue-800 mb-8 text-center">Select Category to Take the Quiz</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300">
                    <a href="{{ route('users.panel.questions', ['category' => $category->id]) }}" class="block text-center">
                        <h2 class="text-2xl font-semibold text-blue-600 mb-4">{{ $category->name }}</h2>
                        <p class="text-gray-500 mb-4">Start the quiz and test your knowledge!</p>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                            Start Quiz
                        </button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-userLayout>