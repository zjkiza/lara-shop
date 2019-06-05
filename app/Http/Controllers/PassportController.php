<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiAuthentication;
use App\Http\Requests\UserLoginApiRequest;
use App\Http\Requests\UserRegisterApiRequest;
use App\Repository\IUser;
use App\User;
use Illuminate\Http\JsonResponse;

class PassportController extends Controller
{
    private const TOKEN_NAME = 'TestForWeb';

    /**
     * @var IUser
     */
    private $user;

    /**
     * PassportController constructor.
     *
     * @param IUser $user
     */
    public function __construct(IUser $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserRegisterApiRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterApiRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->user->create($request);
        $token = $user->createToken(self::TOKEN_NAME)->accessToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @param UserLoginApiRequest $request
     * @throws ApiAuthentication
     * @return JsonResponse
     */
    public function login(UserLoginApiRequest $request): JsonResponse
    {
        if (! auth()->attempt($request->all())) {
            throw new ApiAuthentication('Unauthorised');
        }

        $token = auth()->user()->createToken(self::TOKEN_NAME)->accessToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Returns Authenticated User Details.
     *
     * @return JsonResponse
     */
    public function details(): JsonResponse
    {
        return response()->json(['user' => auth()->user()]);
    }
}
