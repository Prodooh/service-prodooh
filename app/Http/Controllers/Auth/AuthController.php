<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController
{
    /**
     * @param ServerRequestInterface $request
     * @return Collection|JsonResponse
     */
    public function token(ServerRequestInterface $request): Collection|JsonResponse
    {
        try {
            $token = collect(json_decode(parent::issueToken($request)->getContent(), true));
            $user = User::whereEmail(request('username'))
                        ->with([
                            'roles:id,name',
                            'image',
                            'company:id,name' => [
                                'images'
                            ]
                        ])->first();
            return $token->merge(['user' => $user]);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(['error' => 'failed_authentication'], 401);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->revoke();
        return response()->json(['message' => 'ok']);
    }
}
