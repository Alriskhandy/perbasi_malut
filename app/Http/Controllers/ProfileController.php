<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
            // Ganti email/password harus konfirmasi password lama (cegah pembajakan sesi)
            'current_password' => [
                Rule::requiredIf(fn () => $request->filled('password') || $request->email !== $user->email),
                'nullable',
                'current_password',
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->filled('password')) {
            // Keluarkan sesi lain yang mungkin masih login dengan password lama
            Auth::logoutOtherDevices($request->password);
            $request->session()->regenerate();
        }

          notify()->success('Profile updated successfully.');
        return redirect()->route('profile.index');
    }
}
