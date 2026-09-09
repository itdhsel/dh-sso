<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\SsoToken;
use Illuminate\Http\Request;



class SsoValidationController extends Controller
{

    public function validateToken(Request $request)
    {

        $token = $request->input('token');


        if (!$token) {

            return response()->json([
                'valid' => false
            ],401);

        }



        $ssoToken = SsoToken::where('token',$token)
            ->where('expires_at','>',now())
            ->with('user')
            ->first();



        if (!$ssoToken) {

            return response()->json([
                'valid'=>false
            ],401); 

        }



        return response()->json([

            'valid'=>true,


            'user'=>[

                'id'=>$ssoToken->user->id,

                'name'=>$ssoToken->user->name,

                'email'=>$ssoToken->user->email,

            ]

        ]);

    }

}