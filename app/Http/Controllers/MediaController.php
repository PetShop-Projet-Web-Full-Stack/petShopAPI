<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\MediaCreateRequest;
use Illuminate\Database\Eloquent\Collection;

class MediaController extends Controller
{
    public function index(): Collection
    {
        return Media::all();
    }

    public function create(MediaCreateRequest $request): Media
    {
        return Media::create($request->toArray());
    }
}
