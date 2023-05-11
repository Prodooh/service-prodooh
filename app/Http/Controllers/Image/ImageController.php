<?php

namespace App\Http\Controllers\Image;

use App\Enums\DiskTypeEnum;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ImageRequest;
use Exception;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke($type, ImageRequest $request): JsonResponse
    {
        if (!in_array($type, $this->types)) {
            return $this->errorResponse(__('messages.errors.type_not_found'));
        }
        Storage::disk($type)->putFileAs($request->company_id ? '/' . $request->company_id : '' , $request->file, $request->name);
        return $this->successMessage();
    }
}
