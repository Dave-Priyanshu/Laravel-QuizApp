<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function toggleAdmin(User $user){

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('message','User admin status updated successfully.');
    }

    public function edit(User $user){
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, User $user){

        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=>'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name','email'));

        return redirect()->route('admin.users.index')->with('success','User Updated Successfully');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User Deleted Successfully');
    }
}
