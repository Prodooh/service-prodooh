<?php

namespace App\Http\Controllers\Datatable;

use App\Classes\Factories\DatatableFactory;
use App\Classes\GoogleChat\GoogleChatBuilder;
use App\Enums\DatatableTypeEnum;
use App\Http\Controllers\BaseController;
use App\Notifications\GoogleChatCardNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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

        try {
            return Datatables::of(DatatableFactory::createQuery($type))->make(true);
        } catch (Exception $e) {
            $builder = (new GoogleChatBuilder)
                ->title('Handler')
                ->message(
                    json_encode([
                        "error" => $e->getMessage(),
                        "route" => $e->getFile(),
                        "line" => $e->getLine()
                    ])
                );
            Notification::send(null, new GoogleChatCardNotification($builder));
            return response()->json($e);
        }
    }
}
