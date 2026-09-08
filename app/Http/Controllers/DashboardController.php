<?php

namespace App\Http\Controllers;


use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {

        $user = Auth::user();


        $apps = Application::where('active', true)
            ->orderBy('name')
            ->get();


        return view('dashboard', compact(
            'user',
            'apps'
        ));

    }

}