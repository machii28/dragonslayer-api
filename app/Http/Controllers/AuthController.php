<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\User\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        $response = [];

        if (!$token = JWTAuth::attempt($credentials)) {
            $response = $this->setResponse(false, 'Invalid Credentials');
            return response()->json($response, 401);
        }

        $response = $this->setResponse(true, 'Login success', ['token' => $token]);

        return response()->json($response);
    }

    /**
     * @param RegistrationRequest $request
     * 
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        $response = $this->setResponse(true, 'User created', $user);

        return response()->json($response);
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     * @throws ValidationException
     */
    public function logout(Request $request): JsonResponse
    {
        $response = [];
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            $response = $this->setResponse(true, 'Successfully logged out');

            return response()->json($response);
        } catch (JWTException $exception) {
            $response = $this->setResponse(false, 'Server Error');

            return response()->json($response, 500);
        }
    }
}
