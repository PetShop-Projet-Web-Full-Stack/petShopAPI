<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Responses\AnimalResponse;
use App\Responses\AnimalsResponse;
use App\Responses\CreateAnimalResponse;
use App\Http\Requests\AnimalIndexRequest;
use App\Http\Requests\AnimalCreateRequest;

class AnimalController extends Controller
{
    public function show(string $id): array
    {
        $animal = Animal::where('id', $id)->with(['petShop', 'race.species'])->firstOrFail();
        $response = new AnimalResponse($animal->toArray());
        return $response->toArray();
    }

    public function index(AnimalIndexRequest $request): array
    {
        $query = Animal::with(['race.species']);

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
        $reponse = new AnimalsResponse($animals->toArray());
        return $reponse->toArray();
    }

    public function create(AnimalCreateRequest $request): array
    {
        $animal = Animal::create($request->toArray());
        $response = new CreateAnimalResponse($animal->toArray());
        return $response->toArray();
    }
}
