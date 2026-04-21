<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('goods', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('category_id');
            $table->boolean('in_stock')->default(false);
            $table->float('rating')->default(0);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
