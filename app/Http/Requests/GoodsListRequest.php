<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Запрос для получения списка товаров.
 */
final class GoodsListRequest extends FormRequest
{
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
        ];
    }
}
