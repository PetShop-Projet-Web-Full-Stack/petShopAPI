<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Responses\SpeciesResponse;
use App\Responses\CreateSpeciesResponse;
use App\Responses\SingularSpeciesResponse;
use App\Http\Requests\SpeciesCreateRequest;
use Illuminate\Support\Facades\Cache;

class SpeciesController extends Controller
{
    public function show(string $id): array
    {
        return Cache::remember('species_' . $id, 3600, function () use ($id) {
            $species = Species::where('id', $id)->where('status', 1)->first();
            $response = new SingularSpeciesResponse($species->toArray());
            return $response->toArray();
        });
    }

    public function index(): array
    {
        return Cache::remember('species_index', 3600, function () {
            $species = Species::all()->where('status', 1);
            $response = new SpeciesResponse($species->toArray());
            return $response->toArray();
        });
    }

    public function create(SpeciesCreateRequest $request): array
    {
        $species = Species::create($request->toArray());
        $response = new CreateSpeciesResponse($species->toArray());
        return $response->toArray();
    }

    public function delete(string $id): array
    {
        $species = Species::findOrFail($id);
        $species->status = 0;
        $species->save();
        return [];
    }
}
