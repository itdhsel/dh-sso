<?php

namespace App\Http\Controllers;


use App\Models\Application;
use App\Models\SsoToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class SsoController extends Controller
{


    public function launch($code)
    {

        /*
         * Current logged-in user
         */
        $user = Auth::user();


        if (!$user) {

            abort(401);

        }



        /*
         * Find application
         */
        $app = Application::where('code', $code)
            ->where('active', true)
            ->firstOrFail();



        /*
         * Generate secure token
         */
        $token = Str::random(64);



        /*
         * Store token
         */
        SsoToken::create([

            'token' => $token,

            'user_id' => $user->id,

            'application_code' => $app->code,

            'expires_at' => now()->addMinutes(5),

        ]);



        /*
         * Redirect to PHP application
         */
        return redirect(

            $app->url .
            '/sso-login.php?token=' .
            $token

        );

    }


}