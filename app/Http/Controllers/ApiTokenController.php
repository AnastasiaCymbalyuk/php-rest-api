<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function createToken (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
            'device_name' => ['required'],
        ]);
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::chack($request->password, $user->password)) {
            return response()->json(['error' => 'user not fount', 401]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
