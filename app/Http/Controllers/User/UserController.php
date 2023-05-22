<?php

namespace App\Http\Controllers\User;

use App\Actions\Company\CreateCompanyAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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
        $user->update(collect($request->validated())->except('image', 'role')->toArray());
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

    public function store(UserRequest $request, CreateCompanyAction $action)
    {
        $request['company_id'] = $request->company_id ?? $this->getCompanyByDomain($request, $action);
        $user = User::create($request->except('image', 'role'));
        if ($request['image']) {
            $user->image()->create(["url" => $request['image']]);
        }
    }

    public function show(User $user)
    {
        return $user->with(['roles:id', 'image'])->first();
    }

    private function getCompanyByDomain($request, CreateCompanyAction $action)
    {
        $domain = explode('@', $request->email)[1];
        $nameCompany = explode('.', $domain)[0];
        $company = Company::where('name', strtolower($nameCompany))->get();
        if ($company->isNotEmpty()) {
            return $company[0]['id'];
        }
        return $action->execute(["name" => $nameCompany, "country_id" => $request->country_id])->id;
    }
}
