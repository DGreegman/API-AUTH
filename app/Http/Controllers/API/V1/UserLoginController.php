<?php

namespace App\Http\Controllers\API\V1; 

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The Provided Crendentials are Incorrect']
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('user_token')->plainTextToken
        ]);
    }
}
