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
                            login: "#952323", // red
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
    <body class="mb-20 bg-background">
        <nav id="navbar" class="flex justify-between items-center bg-sky-600 text-white py-3 px-4 ">
            <!-- Logo and Title -->
            <div class="flex items-center space-x-3">
                <a href="/">
                    <img class="w-12 md:w-16" src="{{ asset('images/logo.png') }}" alt="Quiz Game Logo" />
                </a>
                <span class="text-lg md:text-xl font-semibold">Quiz Game</span>
            </div>
        
            <!-- Mobile Menu Toggle -->
            <button 
                id="menu-toggle" 
                class="block md:hidden text-white focus:outline-none"
                aria-label="Toggle navigation"
            >
                <i class="fa-solid fa-bars"></i>
            </button>
        
            <!-- Navigation Links -->
            <ul id="menu" class="hidden md:flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-5 text-sm md:text-base">
                @auth
                <li>
                    <span class="font-semibold">Welcome, {{ auth()->user()->name }}</span>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/landingPage" class="hover:text-black">
                        <i class="fa-solid fa-home"></i> Home Page
                    </a>
                </li>
                <li>
                    <a href="/register" class="hover:text-black">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                </li>
                <li>
                    <a href="/login" class="hover:text-black">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                    </a>
                </li>
                @endauth
            </ul>
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
    
    </body>
</html>
