<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Http\Requests\SpeciesCreateRequest;
use Illuminate\Database\Eloquent\Collection;

class SpeciesController extends Controller
{
    public function show(string $id): Species
    {
        return Species::findOrFail($id);
    }

    public function index(): Collection
    {
        return Species::all();
    }

    public function create(SpeciesCreateRequest $request): Species
    {
        return Species::create($request->toArray());
    }
}
