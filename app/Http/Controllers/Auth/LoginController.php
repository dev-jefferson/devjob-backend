<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginValidation;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";


    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }


    public function me(Request $request)
    {
        if (Auth::check()) {
            return response()->json(auth()->user());
        }
        return $this->jwt->parseToken()->authenticate();
    }


    public function login(LoginValidation $request)
    {
        $request->validated();

        $input = $request->all();
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        try {
            $token = auth('api')->attempt(array($fieldType => $input['username'], 'password' => $input['password'], 'is_active' => 1));

            if( !$token ) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }

        return $this->respondWithToken($token);
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
