<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'token' => $user->createToken('APIcourse')->plainTextToken,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function login($data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            return [
                'token' => $user->createToken('MyAuthApp')->plainTextToken,
                'name' => $user->name,
                'email' => $user->email,
            ];
        }

        return null;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }
}
