<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuTranslateController;

Route::get('/menu/{id}/translate', [MenuTranslateController::class, 'translate']);
