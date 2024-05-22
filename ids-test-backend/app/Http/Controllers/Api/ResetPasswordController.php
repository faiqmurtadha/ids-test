<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function passwordResetProcess(UpdatePasswordRequest $request) {
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotfoundError();
    }

    // Verify token is valid
    private function updatePasswordRow($request) {
        return DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    // token not found response
    private function tokenNotFoundError() {
        return response()->json([
            'error' => 'Email or token is wrong'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    // Reset password
    private function resetPassword($request) {
        // find email
        $userData = User::whereEmail($request->email)->first();
        // update password
        $userData->forceFill([
            'password' => Hash::make($request->password)
        ]);

        $userData->save();

        event(new PasswordReset($userData));
        // remove verificatioon data from db
        $this->updatePasswordRow($request)->delete();

        // reset password response
        return response()->json([
            'message' => 'Password has been updated'
        ], Response::HTTP_CREATED);
    }
}
