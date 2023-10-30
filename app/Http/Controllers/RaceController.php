<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Http\Requests\RaceRequest;
use Illuminate\Database\Eloquent\Collection;

class RaceController extends Controller
{
    public function show(string $id): Race
    {
        return Race::findOrFail($id);
    }

    public function index(): Collection
    {
        return Race::all();
    }

    public function create(RaceRequest $request): Race
    {
        return Race::create($request->toArray());
    }
}
