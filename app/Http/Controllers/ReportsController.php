<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function agents()
    {
        $status = request()->status;

        $agents  = User::where('type', '2')->where('status', $status)->get();

        return view('reports.agents', compact('agents', 'status'));
    }
}