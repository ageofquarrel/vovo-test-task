<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\GoodsSortingEnum;

/**
 * DTO для фильтрации списка товаров.
 */
final class GoodsListFiltersDto
{
    /**
     * Инициализация.
     */
    public function __construct(
        public readonly ?string $query,
        public readonly ?float $priceFrom,
        public readonly ?float $priceTo,
        public readonly ?int $categoryId,
        public readonly ?bool $inStock,
        public readonly ?float $ratingFrom,
        public readonly ?GoodsSortingEnum $sort,
        public readonly int $page,
        public readonly int $itemsPerPage,
    ) {
    }

    /**
     * Создание DTO из массива.     *
     */
    public static function fromArray(array $validated): self
    {
        return new self(
            query: self::getNullable($validated, 'q', fn (mixed $v): string => (string) $v),
            priceFrom: self::getNullable($validated, 'price_from', fn (mixed $v): float => (float) $v),
            priceTo: self::getNullable($validated, 'price_to', fn (mixed $v): float => (float) $v),
            categoryId: self::getNullable($validated, 'category_id', fn (mixed $v): int => (int) $v),
            inStock: self::getNullable(
                $validated,
                'in_stock',
                fn (mixed $v): ?bool => filter_var($v, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE),
            ),
            ratingFrom: self::getNullable($validated, 'rating_from', fn (mixed $v): float => (float) $v),
            sort: self::getNullable(
                $validated,
                'sort',
                fn (mixed $v): GoodsSortingEnum => GoodsSortingEnum::from((string) $v),
            ),
            page: (int) $validated['page'],
            itemsPerPage: (int) $validated['items_per_page'],
        );
    }

    /**
     * Получение значения из массива с учетом типа.
     */
    private static function getNullable(array $data, string $key, \Closure $caster): mixed
    {
        if (! array_key_exists($key, $data) || $data[$key] === '' || $data[$key] === null) {
            return null;
        }

        return $caster($data[$key]);
    }
}