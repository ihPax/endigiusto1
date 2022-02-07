<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CondominiumController;

Route::get("/condominiums", [CondominiumController::class, "list"]);
Route::get("/condominiums/{id}", [CondominiumController::class, "detail"]);
Route::post("/condominiums", [CondominiumController::class, "create"]);
Route::put("/condominiums/{id}", [CondominiumController::class, "modify"]);
Route::delete("/condominiums/{id}", [CondominiumController::class, "destroy"]);
