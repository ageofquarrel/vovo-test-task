<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\GoodsListFiltersDto;
use App\Repositories\GoodRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Действие для получения списка товаров.
 */
final class GoodsListAction
{
    /**
     * Инициализация.
     */
    public function __construct(
        private readonly GoodRepository $goodRepository,
    ) {}

    /**
     * Получение списка товаров.
     */
    public function handle(GoodsListFiltersDto $filters): Collection
    {
        return $this->goodRepository
            ->list($filters)
            ->get();
    }
}
