<?php

namespace App\Http\Controllers;

use App\Http\DTOs\Posts\CreatePostDTO;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $apiAcesseToken = $request->session()->get('api_acesse_token');

        return Inertia::render('Posts/List', compact('apiAcesseToken'));
    }

    public function create(Request $request)
    {
        $apiAcesseToken = $request->session()->get('api_acesse_token');

        return Inertia::render('Posts/CreatePost', compact('apiAcesseToken'));
    }

    public function getPosts(Request $request)
    {
        $userId = $request->query('user_id');
        $user = User::query()->find($userId);

        $posts = $user->posts->all();

        return PostsCollection::make($posts);
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
