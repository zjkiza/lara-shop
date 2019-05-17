<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 5/17/19
 * Time: 8:25 AM
 */

namespace App\Repository;


use App\Http\Requests\UserRegisterApiRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUser
{
    public function create(UserRegisterApiRequest $request)
    {
        $request->validated();

        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'guest',
        ]);
    }
}