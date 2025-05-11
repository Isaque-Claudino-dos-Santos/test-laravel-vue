<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    private function mockUser(array $data = [])
    {
        return User::factory()->create([
            'password' => Hash::make('password'),
            'is_admin' => true,
            ...$data
        ]);
    }

    private function mockHeaders(?User $user = null): array
    {
        if (!$user) {
            $user = $this->mockUser();
        }

        return  [
            'accept' => 'application/json',
            'Authorization' => "Bearer {$user->createToken('token')->plainTextToken}"
        ];
    }

    #[Test]
    public function it_should_save_new_post_on_request_api()
    {
        $headers = $this->mockHeaders();

        $payload = [
            'title' => 'my post title',
            'content' => 'my post content'
        ];

        $reponse = $this->post('/api/posts', $payload, $headers)->assertCreated();

        $post = Post::query()->firstWhere($payload);

        $this->assertNotNull($post);

        $reponse->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'created_at' => $post->created_at->toDateTimeString()
            ]
        ]);
    }

    #[Test]
    public function it_should_get_posts_from_user_on_request_api()
    {
        $user = $this->mockUser();
        $headers = $this->mockHeaders($user);

        Post::factory(10)->create([
            'user_id' => $user->id
        ]);

        $response = $this->get("/api/posts?user_id={$user->id}", $headers)
            ->assertOk()
            ->assertJsonFragment([
                "next_page" => null,
                "prev_page" => null,
                "per_pages" => 30,
                "total_data" => 10,
                "total_pages" => 1,
                "current_page" => 1
            ]);


        foreach ($response->json('data') as $postData) {
            $post = Post::find($postData['id']);

            $this->assertNotNull($post);
            $this->assertEquals($post->id, $postData['id']);
            $this->assertEquals($post->title, $postData['title']);
            $this->assertEquals($post->content, $postData['content']);
            $this->assertEquals($post->created_at->toDateTimeString(), $postData['created_at']);
        }
    }

    #[Test]
    public function it_should_return_unauthenticated_on_request_posts_api_routes()
    {
        $this->post("/api/posts")
            ->assertUnauthorized()
            ->assertJson([
                "title" => "Unauthenticated.",
                "description" => null,
                "statusCode" => 401,
                "errorCode" => "UNAUTHENTICATED",
                "fields" => null,
                "instance" => null,
                "timestamp" => Carbon::now()->toDateTimeString(),
            ]);;


        $this->get("/api/posts?user_id=1")
            ->assertUnauthorized()
            ->assertJson([
                "title" => "Unauthenticated.",
                "description" => null,
                "statusCode" => 401,
                "errorCode" => "UNAUTHENTICATED",
                "fields" => null,
                "instance" => null,
                "timestamp" => Carbon::now()->toDateTimeString()
            ]);
    }


    #[Test]
    public function it_should_return_permission_denied_on_request_create_post()
    {
        $user = $this->mockUser(['is_admin' => false]);
        $headers = $this->mockHeaders($user);

        $this->post("/api/posts", [], $headers)
            ->assertUnauthorized()
            ->assertJson([
                "title" => "Permission Denied",
                "description" =>  'You do not have the necessary permission.',
                "statusCode" => 401,
                "errorCode" => 'PERMISSION_DENIED',
                "fields" => null,
                "instance" => null,
                "timestamp" => Carbon::now()->toDateTimeString(),
            ]);;
    }
}
