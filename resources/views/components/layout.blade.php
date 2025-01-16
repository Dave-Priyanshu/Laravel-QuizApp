<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            // login: "#952323", // red
                            login: "#eab308", // Yellow
                            laravel: "#1E3A8A", // Blue primary
                            background: "#F8FAFC", // Light blue-gray background
                            fontCol: "#1E293B", // Darker blue for font
                            white_color: "#FFFFFF", // White for contrast
                        },
                    },
                },
            };
        </script>
        <title>Quiz Game | Learn, Play, Win!</title>
    </head>
    <body class="bg-background">
        <nav class="bg-sky-800 shadow-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <!-- Logo and Title -->
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
        
                <!-- Authenticated/Guest Links -->
                <div class="flex items-center space-x-4">
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
            </div>
        </nav>
        
        
        <script>
            const menuToggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('menu');
        
            menuToggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

        </script>
    

        <main>
            {{ $slot }}
        </main>
     <!-- Footer Section -->
     <footer class="bg-gray-800 text-gray-400 py-8 mt-10">
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
    </body>
</html>
