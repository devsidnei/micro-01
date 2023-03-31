<?php

use App\Http\Controllers\Api\CategoryControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryControler::class);

Route::get('/', fn () => response()->json(['message' => 'success']));
