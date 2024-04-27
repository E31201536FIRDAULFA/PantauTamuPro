<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index(){
        return view ('auth.login');

        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
      
       

        if (Auth::guard('admins')->attempt($credentials)) {
            // Jika otentikasi berhasil
            return redirect()->intended('/dashboard'); // Redirect ke halaman dashboard
        } else {
            // Jika otentikasi gagal
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
<<<<<<< HEAD

      
=======
>>>>>>> 1518b7b6e3b34bf4f6752cfcbb6d72ef7dcea744
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

}
