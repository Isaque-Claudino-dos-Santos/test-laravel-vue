<?php

namespace App\Http\Controllers;

use App\Http\DTOs\Posts\CreatePostDTO;
use App\Http\DTOs\Posts\PostsPaginateFilters;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\GetPostsPaginationQueryService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Posts/List');
    }

    public function create()
    {
        return Inertia::render('Posts/CreatePost');
    }

    public function getPosts(Request $request)
    {
        $filters = PostsPaginateFilters::make($request->query());
        $pagination = new GetPostsPaginationQueryService($filters);

        return PaginationResource::make($pagination->get())->dataResource(PostResource::class);
    }

    public function createPost(CreatePostRequest $request)
    {
        $user = $request->user();
        $dto = CreatePostDTO::make($request->validated());

        $newPost = Post::create([
            'title' => $dto->title,
            'content' => $dto->content,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'data' => PostResource::make($newPost)
        ], Response::HTTP_CREATED);
    }
}
