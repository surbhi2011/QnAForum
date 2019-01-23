<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->getPassword();

        $user= $this->user->create([$name,$email,$password]);

        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
