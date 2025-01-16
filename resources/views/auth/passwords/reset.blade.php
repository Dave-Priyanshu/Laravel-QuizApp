<x-layout>
    <div class="container mx-auto p-8 mt-10 max-w-md bg-white shadow-lg rounded-lg border border-gray-200">
        <h1 class="text-2xl font-bold text-center text-blue-800 mb-6">Reset Your Password</h1>
        <p class="text-gray-600 text-center mb-6">
            Enter your email address and a new password below to reset your account.
        </p>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
    
            <div class="mb-6">
                <label for="email" class="block text-lg font-medium text-blue-800">Email Address</label>
                <input type="email" name="email" id="email" required
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
            </div>
    
            <div class="mb-6">
                <label for="password" class="block text-lg font-medium text-blue-800">New Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
            </div>
    
            <div class="mb-6">
                <label for="password_confirmation" class="block text-lg font-medium text-blue-800">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
            </div>
    
            @error('email')
                <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
            @enderror
            @error('password')
                <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
            @enderror
    
            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                Reset Password
            </button>
        </form>
    </div>
    </x-layout>
    