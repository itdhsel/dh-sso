<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SsoController extends Controller
{
    public function launch($code)
    {
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        // --- Extract Job Description from AD DN ---
        $jobDescription = 'Unknown';
        if ($user->ldap) {
            $dn = $user->ldap->getDn();
            if (preg_match('/OU=([^,]+)/', $dn, $matches)) {
                $jobDescription = $matches[1];
            }
        }
        // ------------------------------------------

        /*
         * Find application in 'applications' table
         */
        $app = DB::table('applications')->where('code', $code)->first();

        if (!$app) {
            abort(404, 'Application not found');
        }

        /*
         * Generate secure token
         */
        $token = Str::random(64);

        /*
         * Store token in 'sso_tokens' table
         */
        DB::table('sso_tokens')->insert([
            'token' => $token,
            'user_id' => $user->id,
            'application_code' => $app->code,
            'job_description' => $jobDescription, // Added to database insert
            'expires_at' => now()->addMinutes(5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
         * Build redirect URL using 'token' parameter key expected by legacy apps
         */
        $baseUrl = rtrim($app->url, '/');
        $separator = str_contains($baseUrl, '?') ? '&' : '?';

        return redirect()->away($baseUrl . $separator . 'token=' . $token);
    }
}