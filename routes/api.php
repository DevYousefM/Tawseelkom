<?php

use App\Http\Controllers\Api\Public\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('public')->group(function () {
    Route::get("/areas", [PublicController::class, "areas"]);
    Route::get("/shipment-types", [PublicController::class, "shipment_types"]);
    Route::get("/route", [PublicController::class, "single_route"]);
});
