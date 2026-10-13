<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $suggestedRole = '';

        if (preg_match('/\(([^)]+)\)[^()]*$/', $user->name, $matches)) {
            $suggestedRole = $matches[1];
        }

        return view('profile.setup', compact('user', 'suggestedRole'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'no_kp'           => 'required|string|max:12',
            'jantina'         => 'required|string',
            'bangsa'          => 'required|string',
            'email'           => 'required|email|max:255',
            'job_description' => 'required|string',
            'gred'            => 'required|string',
            'kumpulan'        => 'required|string',
            'jabatan'         => 'required|string',
        ]);

        $user = Auth::user();
        
        $user->update([
            'name'            => $request->name,
            'no_kp'           => $request->no_kp,
            'jantina'         => $request->jantina,
            'bangsa'          => $request->bangsa,
            'email'           => $request->email,
            'job_description' => $request->job_description,
            'gred'            => $request->gred,
            'kumpulan'        => $request->kumpulan,
            'jabatan'         => $request->jabatan,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}