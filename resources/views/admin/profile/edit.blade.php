<x-adminLayout>
    <div class="container mx-auto p-8 mt-10 max-w-3xl bg-white shadow-xl rounded-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Admin Profile Update</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.panel.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-lg font-medium text-blue-800">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
                    @error('name')
                        <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-lg font-medium text-blue-800">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
                    @error('email')
                        <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio Textarea -->
                <div>
                    <label for="bio" class="block text-lg font-medium text-blue-800">Bio</label>
                    <textarea name="bio" id="bio" rows="4" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Profile Picture -->
                <div>
                    <label for="profile_picture" class="block text-lg font-medium text-blue-800">Profile Picture</label>
                    <div class="flex items-center space-x-4">
                        @if ($user->profile_picture)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-2 border-gray-200 object-cover">
                                <span class="absolute bottom-0 right-0 bg-blue-600 text-white text-xs p-1 rounded-full cursor-pointer">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </div>
                             {{-- <!-- Remove Profile Picture Button -->
                            <form action="{{ route('users.panel.profile.removePicture') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Remove Profile Picture</button>
                            </form> --}}
                        @else
                            <div class="w-32 h-32 rounded-full border-2 border-gray-200 bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="profile_picture" id="profile_picture" class="block w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
                    @error('profile_picture')
                        <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Fields -->
                <div>
                    <label for="password" class="block text-lg font-medium text-blue-800">New Password</label>
                    <input type="password" name="password" id="password" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
                    @error('password')
                        <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-lg font-medium text-blue-800">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition-all">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-adminLayout>
