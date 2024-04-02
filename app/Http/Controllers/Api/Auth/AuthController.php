<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login (Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
            'portal' => 'required|in:System,Employee',
        ]);

        $user = User::where('username', $request->username)->where('portal', $request->portal)->where('is_active', 1)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('Admin')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return 1;
    }
}
