<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request){
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 4) {
              return redirect()->route('managerIndex')->with('success','anda berhasil login');
            }
            return redirect()->route('invIndex')->with('success','anda berhasil login');
        }
        return redirect()->route('login')->withErrors('password atau email yang anda masukkan salah');
    }
    function logout(Request $request){
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('login');
    }
}
