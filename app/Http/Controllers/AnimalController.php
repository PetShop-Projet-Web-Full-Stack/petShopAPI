<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\AnimalRequest;
use Illuminate\Database\Eloquent\Collection;

class AnimalController extends Controller
{
    public function show(string $id): Animal
    {
        return Animal::findOrFail($id);
    }

    public function index(): Collection
    {
        return Animal::all();
    }

    public function create(AnimalRequest $request): Animal
    {
        return Animal::create($request->toArray());
    }
}
