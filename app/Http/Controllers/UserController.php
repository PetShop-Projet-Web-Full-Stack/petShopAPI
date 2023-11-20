<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Retourne all data of user logged
     * @param Request $request // user logged
     * @return array // user data logged
     */
    public function getUser(Request $request)
    {
        return [
            "id"=>$request->user()->id,
            "name"=>$request->user()->name,
            "email"=>$request->user()->email,
            "created_at"=>$request->user()->created_at,
            "updated_at"=>$request->user()->updated_at,
        ];
    }
}
