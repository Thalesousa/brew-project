<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

        return redirect()->route('products.index');
    }
}
