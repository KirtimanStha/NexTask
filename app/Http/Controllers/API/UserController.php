<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest; // Assuming you have a UserRequest class
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show($id): JsonResponse
    {
        $cacheKey = 'user_details_' . $id;

        $userDetails = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($id) {
            return User::find($id);
        });

        $response = ['status' => 200, 'data' => ['user' => new UserResource($userDetails)]];

        return response()->json($response, $response['status']);
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        $user = User::find($id);

        if($user == null) return response()->json(['status' => 404, 'message' => 'User not found'], 404);
        
        $user->update($request->validated());

        $cacheKey = 'user_details_' . $user->id;
        Cache::forget($cacheKey);

        $response = ['status' => 200, 'message' => 'User updated successfully'];

        return response()->json($response, $response['status']);
    }
}
