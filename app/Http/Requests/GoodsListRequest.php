<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\GoodsSortingEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Запрос для получения списка товаров.
 */
final class GoodsListRequest extends FormRequest
{
    /**
     * Нормализация query-параметров.
     */
    protected function prepareForValidation(): void
    {
        if (!$this->has('in_stock')) {
            return;
        }

        $value = $this->input('in_stock');

        if (!is_string($value)) {
            return;
        }

        $normalized = match (strtolower($value)) {
            'true', '1' => true,
            'false', '0' => false,
            default => null,
        };

        if ($normalized !== null) {
            $this->merge(['in_stock' => $normalized]);
        }
    }

    /**
     * Получение правил валидации.
     */
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string'],
            'price_from' => ['nullable', 'numeric', 'decimal:0,2'],
            'price_to' => ['nullable', 'numeric', 'decimal:0,2'],
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'in_stock' => ['nullable', 'boolean'],
            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'sort' => ['nullable', 'string', Rule::enum(GoodsSortingEnum::class)],
            'page' => ['required', 'integer', 'min:1'],
            'items_per_page' => ['required', 'integer', 'min:1'],
        ];
    }
}
