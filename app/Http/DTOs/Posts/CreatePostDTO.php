<?php

namespace App\Http\DTOs\Posts;

readonly class CreatePostDTO
{
    public function __construct(
        public string $title,
        public string $content,
    )
    {
    }

    public static function make(array $data): self
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
        );
    }
}
