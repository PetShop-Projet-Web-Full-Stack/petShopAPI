<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Responses\SpeciesResponse;
use App\Responses\CreateSpeciesResponse;
use App\Responses\SingularSpeciesResponse;
use App\Http\Requests\SpeciesCreateRequest;

class SpeciesController extends Controller
{
    public function show(string $id): array
    {
        $species = Species::findOrFail($id);
        $response = new SingularSpeciesResponse($species->toArray());
        return $response->toArray();
    }

    public function index(): array
    {
        $species = Species::all();
        $response = new SpeciesResponse($species->toArray());
        return $response->toArray();
    }

    public function create(SpeciesCreateRequest $request): array
    {
        $species = Species::create($request->toArray());
        $response = new CreateSpeciesResponse($species->toArray());
        return $response->toArray();
    }
}
