<?php

namespace App\Http\Controllers;

use App\Models\PetShop;
use App\Responses\PetShopResponse;
use App\Responses\PetShopsResponse;
use App\Responses\CreatePetShopResponse;
use App\Http\Requests\PetShopIndexRequest;
use App\Http\Requests\PetShopCreateRequest;

class PetShopController extends Controller
{
    public function show(string $id): array
    {
        $petShop = PetShop::where('id', $id)->with('animals')->firstOrFail();
        $response = new PetShopResponse($petShop->toArray());
        return $response->toArray();
    }

    public function index(PetShopIndexRequest $request): array
    {
        $query = PetShop::with('animals');

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('zipcode')) {
            $query->where('zipcode', 'LIKE', '%' . $request->input('zipcode') . '%');
        }

        $petShops = $query->get();
        $response = new PetShopsResponse($petShops->toArray());
        return $response->toArray();
    }

    public function create(PetShopCreateRequest $request): array
    {
        $petShop = PetShop::create($request->toArray());
        $response = new CreatePetShopResponse($petShop->toArray());
        return $response->toArray();
    }
}
