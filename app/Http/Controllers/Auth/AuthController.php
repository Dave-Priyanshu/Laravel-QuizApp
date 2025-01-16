<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //Show login form
    public function showLoginForm(){
        return view('users.login');
    }

    //handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Redirect based on user role
            return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'user.welcome.page');
        }

        // Return error if login fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //show register form
    public function showRegistrationForm(){
        return view('users.register');
    }

    //handle registration request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        $otp = rand(100000, 999999);

        // Store user data and OTP in the session
        session([
            'registration_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'otp' => $otp,
            ],
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
        ]);

        // Send OTP to the user
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP for Registration');
        });
        // After sending the OTP
        session()->flash('otp_sent', true);

        return redirect()->route('verify.otp')->with('email', $request->email);
    }


    public function showOtpForm(Request $request)
    {
        $email = $request->session()->get('registration_data')['email'] ?? null;

        // Ensure user is not redirected unnecessarily
        if (!$email) {
            return redirect()->route('register')->with('error', 'Session expired. Please register again.');
        }

        return view('auth.verify_otp', compact('email'));
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $registrationData = session('registration_data');
        $otpExpiresAt = session('otp_expires_at');

        // Handle missing session data
        if (!$registrationData) {
            return redirect()->route('verify.otp')->with('error', 'Session expired. Please register again.');
        }

        // Check email mismatch
        if ($registrationData['email'] !== $request->email) {
            return redirect()->route('verify.otp')->with('error', 'Email mismatch. Please try again.');
        }

        // Handle invalid or expired OTP
        if ($registrationData['otp'] !== (int)$request->otp || strtotime($otpExpiresAt) < time()) {
            return redirect()->route('verify.otp')->with('error', '⚠ Invalid or expired OTP.');
        }

        // Create the user in the database
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'email_verified_at' => now(),
        ]);

        // Clear session data
        session()->forget(['registration_data', 'otp_expires_at']);

        // Automatically log in the user
        Auth::login($user);

        return redirect()->route('user.welcome.page');
    }

    // Handle logout request
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // admin profile update
    public function editProfile(){
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicture;
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.panel.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }    

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Send password reset email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
