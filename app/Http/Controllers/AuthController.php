<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login attempt
    public function login(Request $request)
{
    // Hardcoded username and password
    $validUsername = 'admin';
    $validPassword = 'password123';

    // Retrieve input from the request
    $username = $request->input('username');
    $password = $request->input('password');

    // Check credentials
    if ($username === $validUsername && $password === $validPassword) {
        // Redirect to the dashboard
        return redirect()->route('admin');
    } else {
        // Redirect back with an error message
        return back()->with('incorrect_msg', 'Invalid Username or Password');
    }
    }
    // Handle logout
    public function logout()
    {
        Auth::logout();  // Log out the current user
        return redirect('/login');  // Redirect to login page
    }
}

