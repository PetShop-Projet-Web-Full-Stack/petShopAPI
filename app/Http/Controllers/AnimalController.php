<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\AnimalIndexRequest;
use App\Http\Requests\AnimalCreateRequest;
use Illuminate\Database\Eloquent\Collection;

class AnimalController extends Controller
{
    public function show(string $id): Animal
    {
        return Animal::where('id', $id)->with('petShops')->firstOrFail();
    }

    public function index(AnimalIndexRequest $request): Collection
    {
        $query = Animal::with(['races.species']);

        if ($request->has('race')) {
            $query->whereHas('races', function ($q) use ($request) {
                $q->where('name', $request->input('race'));
            });
        }

        if ($request->has('species')) {
            $query->whereHas('races.species', function ($q) use ($request) {
                $q->where('name', $request->input('species'));
            });
        }

        if ($request->has('age_min') && $request->has('age_max')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN ? AND ?', [
                $request->input('age_min'),
                $request->input('age_max'),
            ]);
        }

        return $query->get();
    }

    public function create(AnimalCreateRequest $request): Animal
    {
        return Animal::create($request->toArray());
    }
}
