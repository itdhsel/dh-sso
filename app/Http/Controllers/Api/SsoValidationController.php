<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SsoValidationController extends Controller
{
    public function validateToken(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return response()->json([
                'valid' => false,
                'message' => 'Token missing'
            ], 400);
        }

        // Find token and ensure it hasn't expired
        $ssoToken = DB::table('sso_tokens')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$ssoToken) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid or expired token'
            ], 200);
        }

        // Fetch user linked to this token
        $user = DB::table('users')->where('id', $ssoToken->user_id)->first();

        if (!$user) {
            return response()->json([
                'valid' => false,
                'message' => 'User not found'
            ], 200);
        }

        // Delete the token so it cannot be reused
        DB::table('sso_tokens')->where('token', $token)->delete();

        // Return user data expected by sso-login.php
        return response()->json([
            'valid' => true,
            'user' => [
                'id'       => $user->id,
                'name'     => $user->name ?? $user->username,
                'username' => $user->username,
                'email'    => $user->email ?? '',
            ]
        ]);
    }
}