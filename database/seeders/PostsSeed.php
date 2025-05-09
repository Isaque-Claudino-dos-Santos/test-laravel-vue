<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeed extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Post::factory(2)->create(['user_id' => $user->id]);
        });
    }
}
