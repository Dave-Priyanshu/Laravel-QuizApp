<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'User Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/editor.css') }}">

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Add the Lexend font -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-[#e3f2fd] to-white text-gray-900 font-lexend">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-full lg:w-64 bg-sky-800 text-white p-6 shadow-lg transition-all duration-300">
            <h2 class="text-2xl font-bold mb-6 text-center border-b-2 pb-2">User Panel</h2>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('user.welcome.page') }}" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0l8 6h-2v12h-12v-12h-2l8-6zm0 12h2v8h-2v-8zm-4 0h2v8h-2v-8z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    {{-- <li>
                        <a href="" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-5-14h10v2h-10v-2zm0 4h10v2h-10v-2zm0 4h10v2h-10v-2z"/>
                            </svg>
                            Categories
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('users.panel.profile.edit') }}" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-5-14h10v2h-10v-2zm0 4h10v2h-10v-2zm0 4h10v2h-10v-2z"/>
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.panel.analytics') }}" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-5-14h10v2h-10v-2zm0 4h10v2h-10v-2zm0 4h10v2h-10v-2z"/>
                            </svg>
                            Analytics
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.panel.quiz') }}" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-5-14h10v2h-10v-2zm0 4h10v2h-10v-2zm0 4h10v2h-10v-2z"/>
                            </svg>
                            Quizzes
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                @auth
                    <div class="flex items-center space-x-4">
                        <!-- Profile Picture -->
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-12 h-12 rounded-full border-2 border-gray-300">
                        
                        <!-- User Name and Dashboard Text -->
                        <div class="text-lg font-semibold text-gray-800">
                            <a href="{{ route('users.panel.quiz') }}"><span class="block text-xl font-bold capitalize">{{ auth()->user()->name }}'s Dashboard</span></a>
                        </div>
                    </div>
            
                    <!-- Dashboard Link -->
                    {{-- <a href="{{ route('users.panel.home') }}" class="text-3xl font-semibold text-gray-800 ml-4">Dashboard</a> --}}
            
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center ml-4">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded focus:outline-none focus:ring focus:ring-red-300 transition duration-300">
                            Logout
                        </button>
                    </form>
                @endauth
            </header>
            

            <!-- Main Content -->
            <main class="flex-1 bg-white rounded-lg shadow-lg p-6 mt-4 mx-4 mb-4">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-200 text-center p-4">
                <p class="text-gray-600">&copy; 2024 User Dashboard. All rights reserved.</p>
            </footer>
        </div>
    </div>

    @stack('scripts')

</body>

</html>
