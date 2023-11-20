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
        return $request->user();
    }

}
