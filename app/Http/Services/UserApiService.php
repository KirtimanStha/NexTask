<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UserApiService
{
    public function getUserDetails($userId)
    {
        $response = Http::get('https://api.example.com/users/' . $userId);
        return $response->successful() ? $response->json() : null;
    }
}