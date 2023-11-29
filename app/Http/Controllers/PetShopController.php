<?php

namespace App\Http\Controllers;

use App\Models\PetShop;
use App\Responses\PetShopResponse;
use App\Responses\PetShopsResponse;
use Illuminate\Support\Facades\Cache;
use App\Responses\CreatePetShopResponse;
use App\Http\Requests\PetShopIndexRequest;
use App\Http\Requests\PetShopCreateRequest;

class PetShopController extends Controller
{
    public function show(string $id): array
    {
        return Cache::remember('pet-shop_' . $id, 3600, function () use ($id) {
            $petShop = PetShop::where('id', $id)->where('status', 1)->with('animals', 'media')->firstOrFail();
            $response = new PetShopResponse($petShop->toArray());
            return $response->toArray();
        });
    }

    public function index(PetShopIndexRequest $request): array
    {
        return Cache::remember('pet-shop_index' . $request->has('city') . $request->has('zipcode'), 3600, function () use ($request) {
            $query = PetShop::with('animals', 'media')->where('status', 1);

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('zipcode')) {
            $query->where('zipcode', 'LIKE', '%' . $request->input('zipcode') . '%');
        }

        $petShops = $query->get();
        $response = new PetShopsResponse($petShops->toArray());
        return $response->toArray();
        });
    }

    public function create(PetShopCreateRequest $request): array
    {
        $petShop = PetShop::create($request->toArray());
        $response = new CreatePetShopResponse($petShop->toArray());
        return $response->toArray();
    }

    public function delete(string $id): array
    {
        $petShop = PetShop::findOrFail($id);
        $petShop->status = 0;
        $petShop->save();
        return [];
    }
}
