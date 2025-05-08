<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    public function run(): void
    {

        if (User::query()->where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
        }

        if (User::query()->where('email', 'reader@example.com')->doesntExist()) {
            User::create([
                'name' => 'reader',
                'email' => 'reader@example.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]);
        }
    }
}
