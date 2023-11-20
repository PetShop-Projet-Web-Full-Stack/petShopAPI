<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\UserResponse;

class UserController extends Controller
{
    /**
     * Return all data of user logged
     * @param Request $request // user logged
     * @return array // user data logged
     */
    public function show(Request $request): array
    {
        $user = $request->user();
        $response = new UserResponse($user->toArray());
        return $response->toArray();
    }
}
