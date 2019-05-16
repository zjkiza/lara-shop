<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiAuthenticationException;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\JsonResponse;

class PassportController extends RegisterController
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        /** @var User $user */
        $user = $this->create($request->all());
        $token = $user->createToken('TutsForWeb')->accessToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws ApiAuthenticationException
     */
    public function login(Request $request): JsonResponse
    {
        $this->validateLogin($request);

        if (!auth()->attempt($request->all())) {
            throw new ApiAuthenticationException('Unauthorised');
        }

        $token = auth()->user()->createToken('TutsForWeb')->accessToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Returns Authenticated User Details
     *
     * @return JsonResponse
     */
    public function details(): JsonResponse
    {
        return response()->json(['user' => auth()->user()]);
    }
}
