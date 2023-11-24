<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSoftDestroyRequest;
use App\Models\User;
use App\Responses\UserResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpFoundation\Response;

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

        // Check if user is admin
        if ($user->is_admin) {
            return response()->json(['message' => 'vous ne pouvez pas supprimer un administrateur'], Response::HTTP_FORBIDDEN);
        }

        // Check if user is already deleted
        if ($user->status == 0) {
            return response()->json(['message' => 'utilisateur déjà supprimé'], Response::HTTP_NO_CONTENT);
        }


        $user->status = '0';
        $user->name = 'deleted_' . fake()->name();
        $user->email = 'deleted_' . fake()->email();
        $user->password = 'deleted_' . fake()->password();

        // Update user
        $user->save();

        return response()->json([], 204);
    }

}
