<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request) {
        $userLoggenIn = Auth::user();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (Hash::check($request->old_password, $userLoggenIn->password)) {
            if ($request->password != null && $request->password == $request->confirm_password) {
                $user = User::findOrFail($userLoggenIn->id);
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                ], 409);
            }
        } else {
            return response()->json([
                'success' => false,
            ], 409);
        }
    }
}
