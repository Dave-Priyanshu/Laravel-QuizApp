<x-userLayout>
    @slot('title')
        User Panel
    @endslot
    <div class="container mx-auto p-10 mt-10 max-w-7xl">
        <h1 class="text-4xl font-bold text-blue-800 mb-8 text-center">Welcome to the User Dashboard</h1>

        <div class="flex flex-wrap justify-center gap-6">
            <!-- Quizzes Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-72 text-center transition transform hover:scale-105 hover:shadow-xl">
                <a href="{{ route('users.panel.questions',['category'=> $categoryId->id]) }}" class="text-blue-700 hover:text-blue-800">
                    <div class="icon text-blue-600 mb-4">
                        <i class="fas fa-question-circle text-5xl"></i>
                    </div>
                    <span class="text-xl font-semibold">Start Quiz</span>
                    <p class="mt-2 text-gray-500">Take quizzes and test your knowledge</p>
                </a>
            </div>

            <!-- Categories Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-72 text-center transition transform hover:scale-105 hover:shadow-xl">
                <a href="" class="text-blue-700 hover:text-blue-800">
                    <div class="icon text-blue-600 mb-4">
                        <i class="fas fa-th-large text-5xl"></i>
                    </div>
                    <span class="text-xl font-semibold">Categories</span>
                    <p class="mt-2 text-gray-500">Explore different categories</p>
                </a>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-72 text-center transition transform hover:scale-105 hover:shadow-xl">
                <a href="" class="text-blue-700 hover:text-blue-800">
                    <div class="icon text-blue-600 mb-4">
                        <i class="fas fa-user text-5xl"></i>
                    </div>
                    <span class="text-xl font-semibold">Profile</span>
                    <p class="mt-2 text-gray-500">View and edit your profile</p>
                </a>
            </div>

            <!-- Leaderboard Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-72 text-center transition transform hover:scale-105 hover:shadow-xl">
                <a href="" class="text-blue-700 hover:text-blue-800">
                    <div class="icon text-blue-600 mb-4">
                        <i class="fas fa-trophy text-5xl"></i>
                    </div>
                    <span class="text-xl font-semibold">Leaderboard</span>
                    <p class="mt-2 text-gray-500">See your ranking and compare with others</p>
                </a>
            </div>
        </div>
    </div>
</x-userLayout>
