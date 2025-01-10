<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

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
            <h2 class="text-2xl font-bold mb-6 text-center border-b-2 pb-2">Admin Panel</h2>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-lg font-semibold hover:bg-white hover:text-blue-700 p-3 rounded transition duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-700' : '' }}">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0l8 6h-2v12h-12v-12h-2l8-6zm0 12h2v8h-2v-8zm-4 0h2v8h-2v-8z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center text-lg font-semibold hover:bg-white hover:text-blue-700 p-3 rounded transition duration-300 {{ request()->routeIs('admin.users.index') ? 'bg-white text-blue-700' : '' }}">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 12c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                            </svg>
                            All Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center text-lg font-semibold hover:bg-white hover:text-blue-700 p-3 rounded transition duration-300 {{ request()->routeIs('admin.categories.index') ? 'bg-white text-blue-700' : '' }}">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M4 4h6v6h-6v-6zm0 10h6v6h-6v-6zm10-10h6v6h-6v-6zm0 10h6v6h-6v-6z"/>
                            </svg>                            
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.questions.index') }}" class="flex items-center text-lg font-semibold hover:bg-white hover:text-blue-700 p-3 rounded transition duration-300 {{ request()->routeIs('admin.questions.index') ? 'bg-white text-blue-700' : '' }}">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2c-5.523 0-10 4.477-10 10s4.477 10 10 10 10-4.477 10-10-4.477-10-10-10zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8zm-.002-14c-1.657 0-3 1.343-3 3h2c0-.551.449-1 1-1 .551 0 1 .449 1 1s-.449 1-1 1h-1v2h2v-.29c1.161-.417 2-1.525 2-2.71 0-1.657-1.343-3-3-3zm-1 10h2v2h-2v-2z"/>
                            </svg>                            
                            Questions
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.panel.profile.edit')}}" class="flex items-center text-lg font-semibold hover:bg-white hover:text-blue-700 p-3 rounded transition duration-300 {{ request()->routeIs('admin.panel.profile.edit') ? 'bg-white text-blue-700' : '' }}">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.333 0-10 1.667-10 5v3h20v-3c0-3.333-6.667-5-10-5z"/>
                            </svg>                            
                           Profile Settings
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
                    @if (auth()->user()->profile_picture)
                    <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-12 h-12 rounded-full border-2 border-gray-300">
                    @else
                        <img src="{{ asset('images/default-profile.png')}}" alt="" class="w-12 h-12 rounded-full border-2 border-gray-300">                        
                    @endif

                    <!-- User Name and Dashboard Text -->
                    <div class="text-lg font-semibold text-gray-800">
                        <a href="{{ route('admin.dashboard') }}"><span class="block text-xl font-bold capitalize">{{ auth()->user()->name }}'s Dashboard</span></a>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
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
                <p class="text-gray-600">&copy; 2024 Admin Dashboard. All rights reserved.</p>
            </footer>
        </div>
    </div>

    @stack('scripts')

</body>

</html>
