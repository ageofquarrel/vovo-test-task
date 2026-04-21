<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\GoodsListFiltersDto;
use App\Models\Good;
use Illuminate\Database\Eloquent\Builder;

/**
 * Репозиторий для работы с товарами.
 */
final class GoodRepository
{
    /**
     * Получение списка товаров с фильтрацией.
     */
    public function list(GoodsListFiltersDto $filters): Builder
    {
        return Good::query()
            ->with('category')
            ->when(
                $filters->query !== null && $filters->query !== '',
                fn (Builder $query): Builder => $query->where('name', 'like', '%' . $filters->query . '%')
            )
            ->when(
                $filters->priceFrom !== null,
                fn (Builder $query): Builder => $query->where('price', '>=', $filters->priceFrom)
            )
            ->when(
                $filters->priceTo !== null,
                fn (Builder $query): Builder => $query->where('price', '<=', $filters->priceTo)
            )
            ->when(
                $filters->categoryId !== null,
                fn (Builder $query): Builder => $query->where('category_id', $filters->categoryId)
            )
            ->when(
                $filters->inStock !== null,
                fn (Builder $query): Builder => $query->where('in_stock', $filters->inStock)
            )
            ->when(
                $filters->ratingFrom !== null,
                fn (Builder $query): Builder => $query->where('rating', '>=', $filters->ratingFrom)
            );
    }
}
