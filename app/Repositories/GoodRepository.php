<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\GoodsListFiltersDto;
use App\Enums\GoodsSortingEnum;
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

    /**
     * Сортировка товаров.
     */
    public function sort(Builder $query, GoodsSortingEnum $sort): Builder
    {
        return $query
            ->when(
                $sort === GoodsSortingEnum::PriceAsc,
                fn (Builder $builder): Builder => $builder->orderBy('price', 'asc')
            )
            ->when(
                $sort === GoodsSortingEnum::PriceDesc,
                fn (Builder $builder): Builder => $builder->orderBy('price', 'desc')
            )
            ->when(
                $sort === GoodsSortingEnum::RatingDesc,
                fn (Builder $builder): Builder => $builder->orderBy('rating', 'desc')
            )
            ->when(
                $sort === GoodsSortingEnum::Newest,
                fn (Builder $builder): Builder => $builder->orderBy('created_at', 'desc')
            );
    }
}
