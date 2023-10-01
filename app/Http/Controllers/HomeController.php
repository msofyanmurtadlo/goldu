<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $revenue = number_format($user->revenue, 2);
        $bonus = number_format($user->bonus, 2);
        $total = $user->revenue + $user->bonus;
        $usd = number_format($total, 2);
        return view('home', compact('revenue', 'bonus', 'usd'));
    }
}
