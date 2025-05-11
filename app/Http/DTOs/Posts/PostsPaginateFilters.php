<?php


namespace App\Http\DTOs\Posts;

use Illuminate\Support\Arr;

readonly class PostsPaginateFilters
{
    public function __construct(
        public ?int $userId,
        public ?int $limit,
        public ?int $page,
    ) {}


    public static function make(array $data): self
    {
        return new self(
            userId: Arr::get($data, 'user_id'),
            limit: Arr::get($data, 'limit', 30),
            page: Arr::get($data, 'page', 1)
        );
    }
}
