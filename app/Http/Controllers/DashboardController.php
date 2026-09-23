<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application; // 1. Ensure you import the Application model

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 2. Change this from App::all() or DB::table('apps') to Application::all()
        $apps = Application::all(); 

        return view('dashboard', [
            'user' => $request->user(),
            'apps' => $apps
        ]);
    }
}