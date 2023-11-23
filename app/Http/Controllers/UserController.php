<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSoftDestroyRequest;
use App\Models\User;
use App\Responses\UserResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    /**
     * Return all data of user logged
     * @param Request $request // user logged
     * @return array // user data logged
     */
    public function showMe(Request $request)
    {
        $user = auth()->user();
        $response = new UserResponse($user->toArray());
        return $response->toArray();
    }

    /**
     * Soft remove user into database this method is used for soft delete and change status of user to 0 (inactive)
     * into database and anonymize data of user into database the user token is deleted
     * @param UserSoftDestroyRequest $request the request
     * @return JsonResponse soft remove user
     */
    public function delete(UserSoftDestroyRequest $request)
    {

        // get the user
        $user = User::where('id', $request->id)->first();

        $user->status = '0';
        $user->name = 'deleted_' . fake()->name();
        $user->email = 'deleted_' . fake()->email();
        $user->password = 'deleted_' . fake()->password();

        // Update user
        $user->save();

        return response()->json([], 204);
    }

}
