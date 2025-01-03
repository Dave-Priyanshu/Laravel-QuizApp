<x-layout>
    <div class="container mx-auto py-10">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-center mb-6">Verify Your Email</h1>

            <!-- Display Error Message -->
            @if(session('error'))
                <div class="text-red-500 text-sm mb-4">
                    {{ session('error') }}
                </div>
             @endif
        

            <form action="{{ route('verify.otp.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <!-- OTP Input Field -->
                <div>
                    <label for="otp" class="block text-sm font-medium text-gray-700">Enter OTP:</label>
                    <input type="text" name="otp" id="otp" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('otp')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Verify OTP
                    </button>
                </div>
            </form>

            <!-- Back Link (optional) -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Back to Register</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>

<!-- OTP Sent Popup -->
@if(session('otp_sent'))
    <div id="otp-popup" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-xs mx-auto">
            <h3 class="text-lg font-bold text-center">OTP Sent</h3>
            <p class="text-center text-sm text-gray-600 mt-2">
                An OTP has been sent to your email. Please check your inbox.
            </p>
            <div class="mt-4 text-center">
                <button onclick="closePopup()" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

<script>
    // Close the popup when the button is clicked
    function closePopup() {
        const popup = document.getElementById('otp-popup');
        popup.style.display = 'none';
    }

    // Automatically close the popup after 5 seconds
    setTimeout(() => {
        const popup = document.getElementById('otp-popup');
        if (popup) {
            popup.style.display = 'none';
        }
    }, 5000); // closes after 5 seconds
</script>
