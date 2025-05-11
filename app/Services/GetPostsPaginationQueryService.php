<?php

namespace App\Services;

use App\Http\DTOs\Posts\PostsPaginateFilters;
use App\Models\Post;

class GetPostsPaginationQueryService
{
    public function __construct(
        private readonly PostsPaginateFilters $filters
    ) {}

    private function query()
    {
        return Post::query()
            ->where('user_id', $this->filters->userId)
            ->orderByDesc('created_at');
    }

    public function get()
    {
        return $this->query()->paginate(
            perPage: $this->filters->limit,
            page: $this->filters->page,
            columns: ['id', 'title', 'content', 'created_at']
        );
    }
}
