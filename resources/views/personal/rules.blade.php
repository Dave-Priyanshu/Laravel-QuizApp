<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Game Rules & Regulations</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/rules.css')}}">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Add TailwindCSS -->
</head>
<body class="h-full bg-gradient-to-r from-[#c7e4f8] to-white">

    <!-- Navigation Bar -->
    <nav class="bg-sky-800 shadow-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Quiz Game Logo" class="h-12 w-12">
                </a>
                <div class="hidden md:flex ml-10 space-x-3">
                    @auth
                    <a href="/" :active="request()->is('/')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">Your Dashboard</a>
                    @endauth
                    @guest
                    <a href="/home" :active="request()->is('/home')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">Home</a>
                    @endguest
                    <a href="/about" :active="request()->is('/about')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">About Developer</a>
                </div>
            </div>

            @auth
            <div class="text-lg font-semibold text-white flex items-center space-x-4">
                <span class="block text-xl font-bold capitalize">Hello, {{ auth()->user()->name }}</span>
                @if (auth()->user()->profile_picture)
                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-12 h-12 rounded-full border-2 border-gray-300">
                @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Profile Picture" class="w-12 h-12 rounded-full border-2 border-gray-300">
                @endif
            </div>
            @endauth

            @guest
            <div class="space-x-4">
                <a href="/login" class="text-white hover:bg-yellow-500 px-3 py-2 rounded-md text-sm font-semibold">Login</a>
                <a href="/register" class="text-white px-3 py-2 rounded-md text-sm font-semibold hover:bg-yellow-500">Register</a>
            </div>
            @endguest
        </div>
    </nav>

    <div class="container">
        {{-- <a href="{{ route('landing.page') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Landing Page
        </a> --}}

        <div class="card">
            <h1><i class="fas fa-gamepad text-blue-600"></i> Quiz Game Rules & Regulations</h1>

            <section>
                <h2><i class="fas fa-sign-in-alt"></i> How to Play the Game</h2>
                <p>
                    To participate in the quiz game, you need to sign up and verify your email. Once you are registered and logged in, you can start playing the quiz. 
                    During the game, you will be presented with a series of questions, and you'll need to select the correct answers within the time limit.
                </p>
            </section>

            <section>
                <h2><i class="fas fa-tasks"></i> Game Rules</h2>
                <ul>
                    <li><i class="fas fa-check-circle"></i> The game consists of Timed questions. Each question has a time limit.</li>
                    <li><i class="fas fa-check-circle"></i> You can only answer one question at a time. Once you proceed to the next question, you cannot change your answer in Timed Questions mode.</li>
                    <li><i class="fas fa-check-circle"></i> Points are awarded based on the accuracy and speed of your answers. The faster and more accurate your answer, the higher your points.</li>
                    <li><i class="fas fa-check-circle"></i> If you answer incorrectly, no points will be awarded for that question.</li>
                    <li><i class="fas fa-check-circle"></i> There is no limit to how many times you can play the quiz, but you must wait for the game to reset to start again.</li>
                </ul>
            </section>

            <section>
                <h2><i class="fas fa-cogs"></i> General Etiquette</h2>
                <p>
                    Please be respectful of other players during the game. Any form of cheating, offensive behavior, or harassment will result in disqualification from the game.
                </p>
            </section>

            <section>
                <h2><i class="fas fa-trophy"></i> Scoring & Winning</h2>
                <p>
                    Currently there is no ranking system.You will se your own score in the anaylysis section.
                </p>
            </section>
        </div>
    </div>
    <!-- Footer Section -->
    <footer class="bg-gray-800 text-gray-400 py-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Contact Us</h3>
                <p>Email: priyanshuoffice03@gmail.com</p>
                <p>Phone: Nah, email’s better!</p>
                <p>Address: Ahmedabad, Gujarat, India</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Useful Links</h3>
                <ul>
                    <li><a href="/about" class="hover:text-white">About</a></li>
                    <li><a href="/terms-&-conditions" class="hover:text-white">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-4">Follow Us</h3>
                <div class="flex text-xl space-x-4">
                    <a href="#" class="hover:text-blue-600"><i class="fab fa-facebook"></i></a> <!-- Facebook color -->
                    <a href="#" class="hover:text-[#E4405F]"><i class="fab fa-instagram"></i></a> <!-- Instagram color -->
                    <a href="#" class="hover:text-[#0077B5]"><i class="fab fa-linkedin"></i></a> <!-- LinkedIn color -->
                </div>
            </div>            
        </div>
        <div class="text-center mt-12 text-m">
            &copy; 2025 LaraQuiz. All rights reserved.
        </div>
    </footer>

</body>
</html>
