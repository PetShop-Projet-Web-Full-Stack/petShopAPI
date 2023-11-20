<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return all data of user logged
     * @param Request $request // user logged
     * @return array // user data logged
     */
    public function show(Request $request)
    {
        return $request->user();
    }

}
