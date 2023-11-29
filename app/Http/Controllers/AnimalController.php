<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Responses\AnimalResponse;
use App\Responses\AnimalsResponse;
use App\Responses\CreateAnimalResponse;
use App\Http\Requests\AnimalIndexRequest;
use App\Http\Requests\AnimalCreateRequest;
use Illuminate\Support\Facades\Cache;

class AnimalController extends Controller
{
    public function show(string $id): array
    {
        return Cache::remember('animal_' . $id, 3600, function () use ($id) {
            $animal = Animal::where('id', $id)->where('status', 1)->with(['petShop', 'race.species']);
            if (auth()->check()) {
                $animal->with(['animalsUsers' => function ($q) {
                    $q->where('user_id', auth()->user()->id);
                }]);
            }
            $response = new AnimalResponse($animal->firstOrFail()->toArray());
            return $response->toArray();
        });
    }

    public function index(AnimalIndexRequest $request): array
    {
        return Cache::remember('animals_index' . $request->has('race') . $request->has('species') . $request->has('age_min') . $request->has('age_max'), 3600, function () use ($request) {
            $query = Animal::with(['race.species', 'animalsUsers'])->where('status', 1);

            if (auth()->check()) {
                $query->with(['animalsUsers' => function ($q) {
                    $q->where('user_id', auth()->user()->id);
                }]);
            }

            if ($request->has('race')) {
                $query->whereHas('race', function ($q) use ($request) {
                    $q->where('name', $request->input('race'));
                });
            }

            if ($request->has('species')) {
                $query->whereHas('race.species', function ($q) use ($request) {
                    $q->where('name', $request->input('species'));
                });
            }

            if ($request->has('age_min') && $request->has('age_max')) {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN ? AND ?', [
                    $request->input('age_min'),
                    $request->input('age_max'),
                ]);
            }

            $animals = $query->get();
            $response = new AnimalsResponse($animals->toArray());
            return $response->toArray();
        });
    }

    public function create(AnimalCreateRequest $request): array
    {
        $animal = Animal::create($request->toArray());
        $response = new CreateAnimalResponse($animal->toArray());
        return $response->toArray();
    }

    public function delete(string $id): array
    {
        $animal = Animal::where('id', $id)->firstOrFail();
        $animal->status = 0;
        $animal->save();
        return [];
    }
}
