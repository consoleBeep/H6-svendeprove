<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemorialPageResource;
use App\Http\Resources\MemoryResource;
use App\Models\MemorialPage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Memorial pages
 *
 * A read-only API for listing memorial pages and their memories.
 */
class MemorialPageController extends Controller
{
    /**
     * List memorial pages
     *
     * Returns a paginated list of all memorial pages, ordered alphabetically by name.
     */
    public function index(): AnonymousResourceCollection
    {
        $pages = MemorialPage::query()
            ->orderBy('full_name')
            ->paginate(20);

        return MemorialPageResource::collection($pages);
    }

    /**
     * Get a memorial page
     *
     * Returns the details of a single memorial page.
     */
    public function show(MemorialPage $memorialPage): MemorialPageResource
    {
        return new MemorialPageResource($memorialPage);
    }

    /**
     * List memories for a memorial page
     *
     * Returns a paginated list of memories shared on a memorial page, newest first.
     */
    public function memories(MemorialPage $memorialPage): AnonymousResourceCollection
    {
        $memories = $memorialPage->memories()
            ->with('user')
            ->paginate(20);

        return MemoryResource::collection($memories);
    }
}
