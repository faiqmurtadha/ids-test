<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordRequestController extends Controller
{
    //
    public function sendPasswordResetEmail(Request $request) {
        // if email doesn't exist
        if (!$this->validEmail($request->email)) {
            return response()->json([
                'message' => "Email doesn't exist"
            ], Response::HTTP_NOT_FOUND);
        } else {
            // if email exist
            $this->sendMail($request->email);
            return response()->json([
                'message' => 'Check your email'
            ], Response::HTTP_OK);
        }
    }

    public function sendMail($email) {
        $token = $this->generateToken($email);
        Mail::to($email)->send(new SendMail($token, $email));
    }

    public function validEmail($email) {
        return !!User::where('email', $email)->first();
    }

    public function generateToken($email) {
        $isOtherToken = DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($isOtherToken) {
            return $isOtherToken->token;
        }

        $token = Str::random(80);
        $this->storeToken($token, $email);
        return $token;
    }

    public function storeToken($token, $email) {
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
}
