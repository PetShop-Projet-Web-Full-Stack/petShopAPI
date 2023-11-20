<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Responses\RaceResponse;
use App\Responses\RacesResponse;
use App\Responses\CreateRaceResponse;
use App\Http\Requests\RaceCreateRequest;

class RaceController extends Controller
{
    public function show(string $id): array
    {
        $race = Race::findOrFail($id)->with('species')->first();
        $response = new RaceResponse($race->toArray());
        return $response->toArray();
    }

    public function index(): array
    {
        $race = Race::all();
        $response = new RacesResponse($race->toArray());
        return $response->toArray();
    }

    public function create(RaceCreateRequest $request): array
    {
        $race = Race::create($request->toArray());
        $response = new CreateRaceResponse($race->toArray());
        return $response->toArray();
    }
}
