<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;

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
        $agent_nonactive = User::where('type', 2)->where('status', null)->count();
        $agent_active = User::where('type', 2)->where('status', 'on')->count();
        return view('home', compact(
            'agent_nonactive',
            'agent_active',
        ));
    }
}