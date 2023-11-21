<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSoftDestroyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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

    /**
     * Soft remove user into database this method is used for soft delete and change status of user to 0 (inactive)
     * into database and anonymize data
     * @param UserSoftDestroyRequest $request the request
     * @return JsonResponse soft remove user
     */
    public function softDestroy(UserSoftDestroyRequest $request)
    {
        User::where('id', $request->id)->update([
            'status' => 0,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => fake()->password(),
        ]);

        return response()->json([], 204);
    }

}
