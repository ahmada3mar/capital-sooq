<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (!$token = auth()->attempt($data)) {
            return response()->json(['error' => 'email or password are incorrect'], 422);
        }

        return $this->createNewToken($token);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|exists:users,email',
        ]);

        $user = User::whereEmail($data['email'])->first();
        return $user->resetPassword();
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|min:6|confirmed',
            'api_token' => 'required'
        ]);

        $user = User::whereApiToken($data['api_token'])->firstOrFail();
        $user->password = \bcrypt($data['password']);
        $user->api_token = null;
        $user->save();

        if (!$token = auth()->attempt(['email' => $user->email, 'password' => $data['password']])) {
            return response()->json(['error' => 'invalid invitation link'], 422);
        }

        return $this->createNewToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (auth()->user())
            auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $token = auth()->refresh();
            return $this->createNewToken($token);
        } catch (\Throwable $th) {
            return \response('Unauthenticated User', 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        $user = auth()->user();
        return response()->json([
            'userData' => [
                'id' => $user->id,
                'fullName' =>  $user->name,
                'username' =>  $user->email,
                'email' =>  $user->email,
                'ability' => $user->getAllPermissions()->map(function ($value) {
                    return [
                        'action' => $value->name,
                        'subject' => $value->group,
                    ];
                })
            ],
            'accessToken' => $token,
            'refreshToken' => $token,
        ]);
    }
}
