<?php

namespace App\Http\Controllers\Datatable;

use App\Enums\DatatableTypeEnum;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DatatableController extends BaseController
{
    private array $types = [];

    public function __construct()
    {
        foreach (DatatableTypeEnum::cases() as $enum) {
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
    public function __invoke($type): JsonResponse
    {
        if (!in_array($type, $this->types)) {
            return $this->errorResponse(__('messages.errors.type_not_found'));
        }
        return Datatables::of(DB::table($type))->make(true);
    }
}
