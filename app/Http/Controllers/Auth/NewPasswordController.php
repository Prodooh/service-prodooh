<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class NewPasswordController extends BaseController
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'password' => ['required', 'string']
        ]);

        auth()->user()->update([
            'password' => $request->password,
            'email_verified_at' => now(),
            'is_change_password' => true
        ]);

        return $this->successMessage();
    }
}
