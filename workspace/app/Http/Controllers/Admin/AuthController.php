<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('article.index');
        }
        return view('admin.auth.index');
    }

    public function login(Request $request) {
        $validationRules = ['password' => 'required'];
        $login = $request->input('login');
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $validationRules['email'] = 'required|email';
        } else {
            $validationRules['login'] = 'required';
        }
        $credentials = $request->validate($validationRules);
 
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('tz_offset', $request->input('tz_offset'));
            return redirect()->route('article.index');
            //return redirect()->intended()->with('success', 'You have been logged in!'); // TODO route('article.index');
        }
 
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('admin.auth.index');
    }
}
