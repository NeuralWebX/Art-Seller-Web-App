<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BackendController extends Controller
{
    public function index(){
        return view('backend.pages.dashboard.index');
    }
    public function login(){
        return view('auth.login');
    }
    public function loginSubmit(Request $request){
        $request->validate([
            'input' => 'required',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
        if (auth()->attempt(['username' => $request->input, 'password' => $request->password])) {
            return to_route('backend.index');
        } elseif (auth()->attempt(['email' => $request->input, 'password' => $request->password])) {
            return redirect()->route('backend.index');
        } elseif (auth()->attempt(['phone' => $request->input, 'password' => $request->password])) {
            return to_route('backend.index');
        } else {
            return to_route('backend.auth.login');
        }
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return to_route('backend.auth.login');
    }
}