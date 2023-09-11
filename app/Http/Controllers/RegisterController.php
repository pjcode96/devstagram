<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{

    public function index()
    {

        return view('auth.register');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'max:50'],
            'username' => ['required', 'unique:users', 'min:3', 'max:30'],
            'email' => ['required', 'unique:users', 'email', 'max:100'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);


        User::create([
            'name' => $request->get('name'),
            'username' => Str::slug($request->get('username')),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index');
    }
}