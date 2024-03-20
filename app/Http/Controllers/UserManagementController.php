<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        // Get all users
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        // Get the user
        $user = User::find($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|max:255',
            'role' => 'required',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->date_of_birth = $request->date_of_birth;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        if ($user->save()) {
            return redirect('admin/users')->with('success', 'User updated successfully');
        } else {
            return redirect('admin/users')->with('error', 'Failed to update user');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect('admin/users')->with('success', 'User deleted successfully');
        } else {
            return redirect('admin/users')->with('error', 'Failed to delete user');
        }
    }
}
