<?php

namespace App\Http\Controllers;

use App\Http\DTOs\Posts\CreatePostDTO;
use App\Http\DTOs\Posts\PostsPaginateFilters;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
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
        $users = User::all();

        return Inertia::render('Posts/CreatePost', compact('users'));
    }

    public function getPosts(Request $request)
    {
        $filters = PostsPaginateFilters::make($request->query());
        $pagination = new GetPostsPaginationQueryService($filters);

        return PaginationResource::make($pagination->get())->dataResource(PostResource::class);
    }

    public function createPost(CreatePostRequest $request)
    {
        $dto = CreatePostDTO::make($request->validated());

        $newPost = Post::create([
            'title' => $dto->title,
            'content' => $dto->content,
            'user_id' => $dto->userId,
        ]);

        return response()->json([
            'data' => PostResource::make($newPost)
        ], Response::HTTP_CREATED);
    }
}
