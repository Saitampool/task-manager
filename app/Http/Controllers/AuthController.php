<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect('dashboard');
    }
    return view('auth.login', ["title" => "Login"]);
  }

  public function authenticate(Request $request)
  {
    $validatedata = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if (Auth::attempt($validatedata)) {
      $request->session()->regenerate();


      return redirect()->intended('dashboard');
    }

    return back()->withErrors([
      'login' => 'login gagal',
    ])->withInput();
  }

  public function logout(request $request)
  {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function showRegisterForm()
  {
    return view('auth.register', ["title" => "Register"]);
  }

  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
    ]);

    User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
    ]);

    return redirect('/login')->with('success', 'Registration successful. Please log in.');
  }
}
