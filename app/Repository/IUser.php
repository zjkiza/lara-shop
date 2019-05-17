<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 5/17/19
 * Time: 8:25 AM
 */

namespace App\Repository;


use App\Http\Requests\UserRegisterApiRequest;

interface IUser
{
    public function create(UserRegisterApiRequest $request);
}