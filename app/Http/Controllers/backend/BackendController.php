<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class BackendController extends Controller
{
    public function root()
    {
        return redirect()->route('backend.exibitionEvent.index');
    }
    public function index()
    {
        // if (auth()->user()->role_id == 1) {
        //     $ordersToChartJs = DB::table('orders')
        //         ->select(DB::raw('COUNT(*) as order_count, MONTH(created_at) as month'))
        //         ->groupBy('month')
        //         ->orderBy('month')
        //         ->get()
        //         ->pluck('order_count')
        //         ->toArray();
        // } elseif (auth()->user()->role_id == 2) {
        //     $ordersToChartJs = DB::table('orders')
        //         ->select(DB::raw('COUNT(*) as order_count, MONTH(created_at) as month'))
        //         ->where('user_id', auth()->id())
        //         ->groupBy('month')
        //         ->orderBy('month')
        //         ->get()
        //         ->pluck('order_count')
        //         ->toArray();
        // } else {
        //     $ordersToChartJs = DB::table('orders')
        //         ->select(DB::raw('COUNT(*) as order_count, MONTH(created_at) as month'))
        //         ->groupBy('month')
        //         ->orderBy('month')
        //         ->get()
        //         ->pluck('order_count')
        //         ->toArray();
        // }

        // // Create an array of month names
        // $monthsToChartJs = [
        //     'January', 'February', 'March', 'April', 'May', 'June',
        //     'July', 'August', 'September', 'October', 'November', 'December'
        // ];
        return view('backend.pages.dashboard.index'
        // , compact('ordersToChartJs', 'monthsToChartJs')
        );
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'input' => 'required',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
        if (auth()->attempt(['username' => $request->input, 'password' => $request->password])) {
            Alert::success('Login Success');
            return to_route('backend.index');
        } elseif (auth()->attempt(['email' => $request->input, 'password' => $request->password])) {
            Alert::success('Login Success');
            return redirect()->route('backend.index');
        } elseif (auth()->attempt(['phone' => $request->input, 'password' => $request->password])) {
            Alert::success('Login Success');
            return to_route('backend.index');
        } else {
            Alert::error('Login Failed');
            return to_route('backend.auth.login');
        }
    }
    public function logout()
    {
        auth()->logout();
        Alert::success('Logout Success');
        return to_route('backend.auth.login');
    }
}