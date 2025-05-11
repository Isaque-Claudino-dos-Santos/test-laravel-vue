<?php


namespace App\Services;

use App\Models\User;

class ApiAccessTokenService
{
    public const API_ACCESS_TOKEN_SESSION_KEY = 'api_acesse_token';

    private function createToken(User $user)
    {
        if ($user->isAdmin()) {
            $abilities[] = 'admin';
        }

        $token = $user->createToken(self::API_ACCESS_TOKEN_SESSION_KEY, $abilities ?? []);

        return $token->plainTextToken;
    }

    public function deleteTokens(User $user)
    {
        $user->where('name', self::API_ACCESS_TOKEN_SESSION_KEY)->each(function ($token) {
            $token->delete();
        });
    }

    public function saveTokenInSession(User $user)
    {
        $this->deleteTokens($user);
        $token = $this->createToken($user);
        request()->session()->put(self::API_ACCESS_TOKEN_SESSION_KEY, $token);
    }
}
