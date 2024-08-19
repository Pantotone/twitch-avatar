<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;

class TwitchClient
{
    public function authenticate()
    {
        return Http::post('https://id.twitch.tv/oauth2/token', [
            'client_id' => config('services.twitch.key'),
            'client_secret' => config('services.twitch.secret'),
            'grant_type' => 'client_credentials',
            'redirect_uri' => config('sentinel.twitch.redirect_uri'),
        ])->json();
    }

    public function getStreams(?string $page = null)
    {
        $query = [
            'type' => 'live',
            'after' => $page,
            'first' => 100,
        ];

        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.twitch.token'),
            'Client-Id' => config('services.twitch.key'),
        ])->get('https://api.twitch.tv/helix/streams', $query);
    }

    public function getStreamsByCategory(string $category, ?string $page = null)
    {
        $query = [
            'type' => 'live',
            'after' => $page,
            'game_id' => $category,
            'first' => 100,
        ];

        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.twitch.token'),
            'Client-Id' => config('services.twitch.key'),
        ])->get('https://api.twitch.tv/helix/streams', $query);
    }

    public function getUsers(array $usernames)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.twitch.token'),
            'Client-Id' => config('services.twitch.key'),
        ])->get('https://api.twitch.tv/helix/users', [
            'login' => $usernames,
        ]);
    }

    public function getCategories(string $categoryName)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.twitch.token'),
            'Client-Id' => config('services.twitch.key'),
        ])->get('https://api.twitch.tv/helix/search/categories', "query=$categoryName");
    }
}
