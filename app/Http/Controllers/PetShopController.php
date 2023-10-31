<?php

namespace App\Http\Controllers;

use App\Models\PetShop;
use App\Http\Requests\PetShopCreateRequest;
use App\Http\Requests\PetShopIndexRequest;
use Illuminate\Database\Eloquent\Collection;

class PetShopController extends Controller
{
    public function show(string $id): PetShop
    {
        return PetShop::where('id', $id)->with('animals')->firstOrFail();
    }

    public function index(PetShopIndexRequest $request): Collection
    {
        $query = PetShop::query();

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('zipcode')) {
            $query->where('zipcode', 'LIKE', '%' . $request->input('zipcode') . '%');
        }

        return $query->get();
    }

    public function create(PetShopCreateRequest $request): PetShop
    {
        return PetShop::create($request->toArray());
    }
}
