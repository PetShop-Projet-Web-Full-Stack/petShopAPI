<?php

namespace App\Http\Controllers;

use App\Models\AnimalsUser;
use App\Responses\AnimalsUserResponse;
use App\Http\Requests\AnimalsUserRequest;
use App\Responses\CreateAnimalsUserResponse;

class AnimalsUserController extends Controller
{
    public function index(): array
    {
        $animalsUser = AnimalsUser::where('user_id', auth()->user()->id)->with(['animal', 'animal.petShop', 'animal.race', 'animal.media'])->get();
        $response = new AnimalsUserResponse($animalsUser->toArray());
        return $response->toArray();
    }

    public function create(AnimalsUserRequest $request): array
    {
        $animal = AnimalsUser::create(
            [
                'user_id' => auth()->user()->id,
                'animal_id' => $request->id,
            ]
        );

        $response = new CreateAnimalsUserResponse($animal->toArray());
        return $response->toArray();
    }

    public function delete(string $id): array
    {
        $animal = AnimalsUser::where('user_id', auth()->user()->id)->where('animal_id', $id)->firstOrFail();
        $animal->delete();
        return [];
    }
}
