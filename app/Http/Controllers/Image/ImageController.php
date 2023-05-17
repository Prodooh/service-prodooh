<?php

namespace App\Http\Controllers\Image;

use App\Enums\DiskTypeEnum;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ImageRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{
    private array $types = [];

    public function __construct()
    {
        foreach (DiskTypeEnum::cases() as $enum) {
            $this->types[] = $enum->value;
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param $type
     * @param ImageRequest $request
     * @return JsonResponse
     */
    public function __invoke($type, ImageRequest $request):string
    {
        if (!in_array($type, $this->types)) {
            return $this->errorResponse(__('messages.errors.type_not_found'));
        }
        return match ($type) {
            'users' => self::usersImage($request),
            default => $this->successMessage()
        };

    }

    public function usersImage($request){
        return $request->file->store('','users');
    }
}
