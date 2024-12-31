<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Show login form
    public function showLoginForm(){
        return view('users.login');
    }

    //handle login request
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Check if the logged-in user is an admin or a regular user
            $user = Auth::user();

            //redirection based on roles
            if($user->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->route('user.welcome.page');
            }

        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ]);
    }


    //show register form
    public function showRegistrationForm(){
        return view('users.register');
    }

    //handle registration request
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
        ]);

        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
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
}
