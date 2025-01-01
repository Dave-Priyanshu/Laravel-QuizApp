<!-- resources/views/users/welcome.blade.php -->

<x-userLayout>
    
        <h1 class="text-4xl font-bold text-blue-800 mb-6 text-center capitalize">Welcome, {{ auth()->user()->name }}!</h1>
        
        <!-- Welcome Message -->
        <p class="text-xl text-gray-700 mb-6">Welcome to your Quiz Dashboard! 🎉</p>
        <p class="text-lg text-gray-600 mb-6">This is where your quiz adventure begins. You can explore various quizzes, track your progress, and improve your skills over time. Whether you want to challenge yourself or just have fun, we've got you covered!</p>
        <!-- About You Section -->
    <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-200 mb-8">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">About You</h2>
        <div class="flex items-center mb-4">
            <!-- Profile Photo -->
            @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="shadow-xl w-16 h-16 rounded-full object-cover mr-4">
            @else
                <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                    <i class="fa-solid fa-user text-gray-500"></i>
                </div>
            @endif

            <!-- User Info -->
            <div>
                <h3 class="text-xl font-semibold text-blue-800">{{ auth()->user()->name }}</h3>
                <p class="text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <!-- Bio Section -->
        @if(auth()->user()->bio)
            <p class="text-lg text-gray-600">{{ auth()->user()->bio }}</p>
        @else
            <p class="text-sm text-gray-500">You haven't added a bio yet. <a href="{{ route('users.panel.profile.edit') }}" class="font-semibold text-blue-700">Add your bio here</a>.</p>
        @endif

        <!-- Profile Picture Section -->
        @if(auth()->user()->profile_picture)
            <p class="text-sm text-gray-500">Your profile picture is set! 🎉</p>
        @else
            <p class="text-sm text-gray-500">You haven't uploaded a profile picture yet. <a href="{{ route('users.panel.profile.edit') }}" class="font-semibold text-blue-700">Add a profile picture here</a>.</p>
        @endif
        <h2 class="mt-10 text-2xl font-semibold text-blue-700 mb-4">Let's Get Started</h2>
        <p class="text-lg text-gray-600 mb-6">Great job, {{ auth()->user()->name }}! Based on your name, I think this quiz category would be perfect for you:</p>
        
        <!-- Random Quiz Category Suggestion -->
        @php
            $randomCategory = \App\Models\Category::inRandomOrder()->first();
        @endphp
        <p class="text-lg text-gray-600 mb-4">How about starting with the <span class="font-semibold text-blue-700">{{ $randomCategory->name }}</span> category? You can explore it <a href="{{ route('users.panel.quiz', ['category' => $randomCategory->id]) }}" class="font-semibold text-blue-700">here</a>.</p>
    </div>
     
        <!-- Why Quizzes are Important -->
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Why Quizzes Are Important?</h2>
        <p class="text-lg text-gray-600 mb-6">
            Quizzes are a great way to test and improve your knowledge on various topics. They help you reinforce what you've learned, track your progress, and keep you engaged in a fun and interactive way. By participating in quizzes, you can sharpen your mind and learn new things every day.
        </p>

        <!-- Features Done -->
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">✅ Features You Can Enjoy</h2>
        <ul class="list-inside list-disc text-lg text-gray-600 mb-6">
            <li>Login and Registration</li>
            <li><a href="{{route('users.panel.profile.edit')}}" class="font-semibold text-blue-700">Profile</a> Update</li>
            <li>View All Categories of <a href="{{route('users.panel.quiz')}}" class="font-semibold text-blue-700">Quizzes</a></li>
            <li>Play Quizzes</li>
            <li>Track Your Performance with <a href="{{route('users.panel.analytics')}}" class="font-semibold text-blue-700">Analytics</a></li>
        </ul>

        <!-- Upcoming Features -->
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">🚀 Upcoming Features</h2>
        <p class="text-lg text-gray-600 mb-6">
            We are constantly working to improve your experience! Here are some of the exciting features coming soon:
        </p>
        <ul class="list-inside list-disc text-lg text-gray-600 mb-6">
            <li><strong>Social Login Integration:</strong> Log in with your favorite social accounts.</li>
            <li><strong>Mail System:</strong> Stay updated with notifications and reminders.</li>
            <li><strong>Timed Questions:</strong> Challenge yourself with time-limited questions!</li>
            <li><strong>Randomized Questions:</strong> Get a fresh set of questions every time.</li>
            <li><strong>Award Points for Correct Answers:</strong> Earn points for every correct answer.</li>
            <li><strong>Quiz Difficulty Levels:</strong> Choose between Easy, Medium, and Hard levels.</li>
            <li><strong>Hint System:</strong> Use earned points to get hints for difficult questions.</li>
            <li><strong>Achievements & Badges:</strong> Unlock badges as you complete milestones!</li>
        </ul>

        <!-- Gamification Features -->
        <h3 class="text-2xl font-semibold text-blue-700 mb-4">🎮 Gamification Features</h3>
        <ul class="list-inside list-disc text-lg text-gray-600 mb-6">
            <li><strong>Daily Challenges:</strong> Take part in daily challenges and win exciting rewards!</li>
            <li><strong>Coins and Rewards:</strong> Earn coins for correct answers and redeem them for hints or new categories!</li>
            <li><strong>Streak Tracking:</strong> Play daily to keep your streak alive and earn rewards!</li>
        </ul>

        <!-- Closing Section -->
        <div class="mt-6 text-center">
            <p class="text-lg text-gray-600 mb-6">We're thrilled to have you here, {{ auth()->user()->name }}. Get ready to dive into the world of quizzes and explore your potential!</p>
            <a href="{{ route('users.panel.quiz') }}" class="inline-block bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Play Your First Quiz
            </a>
        </div>

</x-userLayout>
