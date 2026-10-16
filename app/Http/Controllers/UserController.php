<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all(); // You can also add pagination or filtering here if needed
        return view('backend.users.index', compact('users'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
            'is_admin' => 'required|boolean',
        ]);

        // is_admin sengaja tidak ada di $fillable, jadi diset eksplisit
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->is_admin = $request->boolean('is_admin');
        $user->save();
          notify()->success('User added successfully!');
        return redirect()->route('users.index');
    }

    // Show the form for editing a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Update the specified user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
        ]);

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // Admin tidak boleh mencabut hak admin dirinya sendiri
        if ($user->id !== Auth::id()) {
            $user->is_admin = $request->boolean('is_admin');
        }
        $user->save();

        notify()->success('User updated successfully!');
        return redirect()->route('users.index');
    }

    // Delete the specified user
    public function destroy($id)
    {
        if ((int) $id === 1 || (int) $id === Auth::id()) {
            abort(403, 'User ini tidak dapat dihapus.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        notify()->success('User deleted successfully!');
        return redirect()->route('users.index');
    }
}
