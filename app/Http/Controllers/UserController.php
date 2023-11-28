<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\UserSoftDestroyRequest;
use App\Models\User;
use App\Responses\UserResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Display admin login page
     * @return Application|Factory|View
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * Login process for admin
     * @param AdminLoginRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function loginPost(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }


        return view('admin.login')->withErrors([
            'email' => 'Les identifiants ne correspondent pas',
        ]);

    }

    /**
     * Logout process for admin
     * @return RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }

}
