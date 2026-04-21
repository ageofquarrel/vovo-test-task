<?php

declare(strict_types=1);

use App\Http\Controllers\GoodController;
use Illuminate\Support\Facades\Route;

Route::get('/goods', [GoodController::class, 'list']);
