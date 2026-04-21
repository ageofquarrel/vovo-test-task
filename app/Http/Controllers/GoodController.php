<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GoodsListAction;
use App\DTOs\GoodsListFiltersDto;
use App\Http\Requests\GoodsListRequest;
use App\Http\Resources\GoodsListResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Контроллер для работы с товарами.
 */
final class GoodController extends Controller
{
    /**
     * Инициализация.
     */
    public function __construct(
        private readonly GoodsListAction $goodsListAction,
    ) {}

    /**
     * Получение списка товаров.
     */
    public function list(GoodsListRequest $request): AnonymousResourceCollection
    {
        $dto = GoodsListFiltersDto::fromArray($request->validated());

        return GoodsListResource::collection(
            $this->goodsListAction->handle($dto)
        );
    }
}
