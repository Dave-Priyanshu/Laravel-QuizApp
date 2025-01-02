<x-userLayout>
    <div class="container mx-auto p-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-blue-800 mb-8 text-center">Select Category to Take the Quiz</h1>

        @if(session('score'))
        <div id="scoreMessage" class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 opacity-0" style="transition: opacity 1s;">
            <p class="text-xl font-semibold capitalize">Congratulations, {{ auth()->user()->name }}!</p>
            <p class="text-lg">You answered <span class="font-bold text-blue-700">{{ session('correctAnswers') }}</span> out of <span class="font-bold text-blue-700">{{ session('totalQuestions') }}</span> questions correctly.</p>
            <p class="text-lg">Your score is: <span class="font-bold text-blue-700">{{ session('score') }}%</span></p>
            <p class="text-sm">{{ session('message') }}</p>
        </div>
        
        <script>
            document.getElementById('scoreMessage').style.opacity = 1;
            setTimeout(function() {
                const scoreMessage = document.getElementById('scoreMessage');
                scoreMessage.style.opacity = 0;

                setTimeout(function() {
                    scoreMessage.style.display = 'none';
                }, 1000); // 1000 ms = 1 second (duration of the fade-out animation)
            }, 4000); // Fade out after 5 seconds
        </script>
        @endif

        <!-- Daily Quiz Challenges Section -->
        <div class="mb-6 p-6 border-2 border-gray-300 rounded-lg">
            <h2 class="text-2xl font-semibold text-center mb-4">Daily Quiz Challenges</h2>
            
            <!-- Filter Options -->
            <div class="flex justify-center gap-6">
                <a href="{{ route('quiz.timed') }}" class="bg-sky-500 text-white px-4 py-2 rounded-full hover:bg-blue-500">Timed Questions</a>
                <a href="{{ route('quiz.show', ['type' => 'multiple_choice']) }}" class="bg-sky-600 text-white px-4 py-2 rounded-full hover:bg-blue-600">Multiple Choice Questions</a>
                <a href="{{ route('quiz.show', ['type' => 'true_false']) }}" class="bg-sky-700 text-white px-4 py-2 rounded-full hover:bg-blue-700">True or False Questions</a>
            </div>
        </div>


        <!-- Category Grid -->
        <div id="categories-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="category-item bg-sky-100 p-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300"
                     data-category-type="{{ $category->type }}">
                    <a href="{{ route('users.panel.questions', ['category' => $category->id]) }}" class="block text-center">
                        <h2 class="text-2xl font-semibold text-blue-700 mb-4">{{ $category->name }}</h2>
                        <p class="text-gray-600 mb-4">Start the quiz and test your knowledge!</p>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                            Start Quiz
                        </button>
                    </a>
                </div>
            @endforeach
        </div>
        
        <div>
            {{ $categories->links() }}
        </div>
    </div>

    <script>
        // Get all filter buttons and category items
        const timedBtn = document.getElementById('timedQuestions');
        const multiChoiceBtn = document.getElementById('multiChoiceQuestions');
        const trueFalseBtn = document.getElementById('trueFalseQuestions');
        const categoryItems = document.querySelectorAll('.category-item');

        // Filter categories based on type
        function filterCategories(type) {
            categoryItems.forEach(item => {
                const categoryType = item.getAttribute('data-category-type');
                if (type === 'all' || categoryType === type) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Event listeners for each filter button (timed, multiple_choice, true_false)
        timedBtn.addEventListener('click', () => filterCategories('timed'));
        multiChoiceBtn.addEventListener('click', () => filterCategories('multiple_choice'));
        trueFalseBtn.addEventListener('click', () => filterCategories('true_false'));

        // Initialize to show all categories by default
        filterCategories('all');
    </script>
</x-userLayout>
