<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::post('category/tree', [CategoryController::class, 'treeView']);
