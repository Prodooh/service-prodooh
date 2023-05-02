<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Mail\UpdatePasswordConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewPasswordController extends BaseController
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        request()->validate([
            'password' => ['required', 'string']
        ]);

        $user = auth()->user();

        $user->update([
            'password' => request('password'),
            'email_verified_at' => now(),
            'is_change_password' => true,
        ]);

        Mail::to($user->email)->send(new UpdatePasswordConfirmation($user));

        return $this->successMessage();
    }
}
