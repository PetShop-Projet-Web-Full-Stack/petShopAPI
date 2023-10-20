<?php

namespace App\Http\Controllers;

use App\Models\PetShop;
use App\Http\Requests\PetShopRequest;
use Illuminate\Database\Eloquent\Collection;

class PetShopController extends Controller
{
    public function show(string $id): PetShop
    {
        return PetShop::findOrFail($id);
    }

    public function index(): Collection
    {
        return PetShop::all();
    }

    public function create(PetShopRequest $request): PetShop
    {
        return PetShop::create($request->toArray());
    }
}
