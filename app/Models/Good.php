<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Good extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'price', 
        'category_id', 
        'in_stock', 
        'rating',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'in_stock' => 'boolean',
            'rating' => 'float',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
