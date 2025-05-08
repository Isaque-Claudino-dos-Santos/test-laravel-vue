<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class PostsCollection extends ResourceCollection
{
    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(function ($item) {
            return PostResource::make($item);
        });
    }
}
