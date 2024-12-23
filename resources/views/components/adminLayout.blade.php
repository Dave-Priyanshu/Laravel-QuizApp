<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
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
            <h2 class="text-2xl font-bold mb-6 text-center border-b-2 pb-2">Admin Panel</h2>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0l8 6h-2v12h-12v-12h-2l8-6zm0 12h2v8h-2v-8zm-4 0h2v8h-2v-8z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm1-15h-2v4h2v-4zm0 6h-2v2h2v-2z"/>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-5-14h10v2h-10v-2zm0 4h10v2h-10v-2zm0 4h10v2h-10v-2z"/>
                            </svg>
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-11c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 4c-.55 0-1 .45-1 1v3h2v-3c0-.55-.45-1-1-1z"/>
                            </svg>
                            Questions
                        </a>
                    </li>
                    
                    <li>
                        <a href="#" class="flex items-center text-lg font-semibold hover:bg-blue-700 p-3 rounded transition duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-5.522 0-10-4.478-10-10s4.478-10 10-10 10 4.478 10 10-4.478 10-10 10zm-1-14h2v4h-2v-4zm0 6h2v2h-2v-2z"/>
                            </svg>
                            Settings
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
                <a href="{{ route('admin.dashboard') }}" class="text-3xl font-semibold text-gray-800">Dashboard</a>
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
