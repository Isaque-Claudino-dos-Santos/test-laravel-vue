<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    private ?string $dataResource;

    private function getNextPageFromUrl(): ?int
    {
        $url = $this->nextPageUrl();

        return !$url ? null : uri($url)->query()->get('page');
    }

    private function getPreviousPageFromUrl(): ?int
    {
        $url = $this->previousPageUrl();

        return !$url ? null : uri($url)->query()->get('page');
    }

    private function getData()
    {
        if (!$this->dataResource) {
            return $this->items();
        }

        return $this->dataResource::collection($this->items());
    }

    public function dataResource(string $dataResource)
    {
        $this->dataResource = $dataResource;
        return $this;
    }

    public function toArray(Request $request): array
    {
        return [
            'next_page' => $this->getNextPageFromUrl(),
            'prev_page' => $this->getPreviousPageFromUrl(),
            'per_pages' => $this->perPage(),
            'total_data' => $this->total(),
            'total_pages' => ceil($this->total() / $this->perPage()),
            'current_page' => $this->currentPage(),
            'data' => $this->getData()
        ];
    }
}
