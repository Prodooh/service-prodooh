<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UserController extends BaseController
{
    /**
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $this->authorize($user);
        $user->update($request->except('image','role'));
        return $this->successMessage();
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->successMessage();
    }

    /**
     * @return JsonResponse
     */
    public function updatePreferences()
    {
        $user = auth()->user();
        $user->update([
            'payload' => request('payload')
        ]);
        return $this->successMessage();
    }

    public function store(){

    }
}
