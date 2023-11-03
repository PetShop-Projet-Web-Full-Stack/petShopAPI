<?php

namespace App\Http\Controllers;

use App\Models\AnimalsUser;
use App\Http\Requests\AnimalsUserRequest;
use Illuminate\Database\Eloquent\Collection;

class AnimalsUserController extends Controller
{
    public function index(): Collection
    {
        return AnimalsUser::where('users_id', auth()->user()->id)->with('animal')->get();
    }

    public function create(AnimalsUserRequest $request): AnimalsUser
    {
        return AnimalsUser::create(
            [
                'users_id' => auth()->user()->id,
                'animal_id' => $request->id,
            ]
        );
    }
}
