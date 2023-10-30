<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\MediaRequest;
use Illuminate\Database\Eloquent\Collection;

class MediaController extends Controller
{
    public function index(): Collection
    {
        return Media::all();
    }

    public function create(MediaRequest $request): Media
    {
        return Media::create($request->toArray());
    }
}
