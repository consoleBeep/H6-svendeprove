<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemorialPageResource;
use App\Http\Resources\MemoryResource;
use App\Models\MemorialPage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MemorialPageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $pages = MemorialPage::query()
            ->orderBy('full_name')
            ->paginate(20);

        return MemorialPageResource::collection($pages);
    }

    public function show(MemorialPage $memorialPage): MemorialPageResource
    {
        return new MemorialPageResource($memorialPage);
    }

    public function memories(MemorialPage $memorialPage): AnonymousResourceCollection
    {
        $memories = $memorialPage->memories()
            ->with('user')
            ->paginate(20);

        return MemoryResource::collection($memories);
    }
}
