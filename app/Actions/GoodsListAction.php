<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\GoodsListFiltersDto;
use App\Repositories\GoodRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function handle(GoodsListFiltersDto $filters): LengthAwarePaginator
    {
        $query = $this->goodRepository->list($filters);

        if ($filters->sort !== null) {
            $query = $this->goodRepository->sort($query, $filters->sort);
        }

        return $query->paginate(
            perPage: $filters->itemsPerPage,
            columns: ['*'],
            pageName: 'page',
            page: $filters->page,
        );
    }
}
