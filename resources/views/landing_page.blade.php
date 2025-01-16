<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Game - Test Your Knowledge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navlayout.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    {{-- Testimonial --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body class="h-full">
<div class="min-h-full">
    <!-- Navigation Bar -->
<nav class="bg-sky-800 shadow-md"> <!-- Changed to bg-blue-600 for a lighter background -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Quiz Game Logo" class="h-12 w-12">
            <div class="hidden md:flex ml-10 space-x-3">
                @auth
                <a href="/" :active="request()->is('/')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">Your Dashboard</a>
                @endauth
                @guest
                <a href="/landingPage" :active="request()->is('/landingPage')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">Home</a>
                @endguest
                <a href="/about" :active="request()->is('/about')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">About Developer</a>
                {{-- <a href="/contact" :active="request()->is('/contact')" class="text-white font-semibold hover:bg-white hover:text-blue-700 px-3 py-2 rounded-md text-m">Contact</a> --}}
            </div>
        </div>

        {{-- For Authenticated Users --}}
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

        {{-- For Guest Users --}}
        @guest    
        <div class="space-x-4">
            <a href="/login" class="text-white hover:bg-yellow-500 px-3 py-2 rounded-md text-sm font-semibold">Login</a>
            <a href="/register" class="text-white px-3 py-2 rounded-md text-sm font-semibold hover:bg-yellow-500">Register</a>
        </div>
        @endguest
    </div>
</nav>


    <!-- Hero Section -->
    <div class="relative bg-blue-600 text-white text-center py-16">
        <img src="{{ asset('images/quiz_hero.jpg') }}" alt="Quiz Hero" class="absolute inset-0 w-full h-full object-cover opacity-50">
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-5xl font-bold mb-4">Welcome to the Quiz Game!</h1>
            <p class="text-lg mb-6">Challenge yourself with fun quizzes on various topics. Are you ready to test your knowledge?</p>
            <a href="{{ route('users.panel.quiz') }}" class="bg-yellow-500 text-blue-800 px-6 py-3 rounded-lg text-lg font-semibold hover:bg-yellow-600">Play Now</a>
        </div>
    </div>

    <!-- Features Section -->
    <section class="bg-gradient-to-r from-indigo-50 to-blue-100 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">Why Play Our Quiz Game?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-trophy text-blue-500 text-5xl mb-6"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Earn Points</h3>
                    <p class="text-gray-600 text-base">Answer questions correctly and accumulate points to show off your knowledge.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-medal text-blue-500 text-5xl mb-6"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Leaderboard</h3>
                    <p class="text-gray-600 text-base">Compete with friends or other players and climb to the top of the leaderboard.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-layer-group text-blue-500 text-5xl mb-6"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Multiple Categories</h3>
                    <p class="text-gray-600 text-base">Explore quizzes in categories like Science, History, Entertainment, and more.</p>
                </div>
            </div>
        </div>
    </section>


   <!-- Testimonials Section -->
   <section class="bg-gradient-to-r from-indigo-200 to-blue-100 py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">What Our Players Say</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="bg-white p-8 rounded-xl shadow-md max-w-md mx-auto transition-transform duration-300 transform hover:scale-105">
                            <p class="text-gray-600 italic text-lg mb-4">"{{ $testimonial->review }}"</p>
                            <div class="flex items-center justify-center mb-4">
                                <!-- User Image -->
                                <img 
                                    src="{{ optional($testimonial->user)->profile_picture 
                                        ? asset(optional($testimonial->user)->profile_picture) 
                                        : asset('images/anonymous-man.png') }}" 
                                    alt="User Image" 
                                    class="w-12 h-12 rounded-full object-cover mr-4">
                                <div class="text-blue-800 font-semibold">{{ optional($testimonial->user)->name ?? 'Anonymous' }}</div>
                            </div>
                            <div class="text-yellow-500">
                                @for ($i = 1; $i <= $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = $testimonial->rating + 1; $i <= 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- FontAwesome (for stars) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Swiper Initialization -->
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

    {{-- Testimonial Form --}}
    <div class="bg-white p-8 rounded-xl shadow-xl my-4 max-w-2xl mx-auto">
        <h3 class="text-3xl font-semibold text-sky-800 text-center mb-8">Your Review Matters</h3>
        <form action="{{ route('testimonial.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="review" class="block text-lg font-bold text-gray-700 mb-2">Your Feedback</label>
                <textarea name="review" id="review" rows="4" class="w-full p-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Share your thoughts..." required></textarea>
            </div>
            
            <div class="mb-6">
                <label for="rating" class="block text-lg font-bold text-gray-700 mb-2">Rating</label>
                <select name="rating" id="rating" class="w-full p-3 border rounded-xl bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Rating</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>
            
            <div class="flex justify-center">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition duration-300 transform hover:scale-105">Submit Testimonial</button>
            </div>
        </form>
    </div>


    <!-- Call to Action Section -->
    <section class="bg-blue-800 text-white py-6">
        <div class="w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Start the Fun?</h2>
            <p class="text-lg mb-8">Sign up now and join millions of players challenging their minds.</p>
            <a href="/register" class="bg-yellow-500 text-blue-800 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-600">Get Started</a>
        </div>
    </section>

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
                    <li><a href="/about" class="hover:text-white">About Us</a></li>
                    <li><a href="/rules" class="hover:text-white">Terms of Service</a></li>
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
</div>
</body>
</html>
