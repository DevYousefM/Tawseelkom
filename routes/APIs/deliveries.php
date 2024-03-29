<?php

use App\Http\Controllers\Api\Deliveries\AuthController;
use App\Http\Controllers\Api\Deliveries\DeliveryOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, "login"]);

Route::middleware(['jwt.verify'])->group(function () {
  Route::get('profile', [AuthController::class, "profile"]);
  Route::post('logout', [AuthController::class, "logout"]);
  Route::post('delete-profile', [AuthController::class,"delete_profile"]);

  Route::get('orders', [DeliveryOrderController::class, "index"]);
  Route::post('take-order/{id}', [DeliveryOrderController::class, "take_order"]);
  Route::get('taken-orders', [DeliveryOrderController::class, "taken_orders"]);
  Route::post('complete-order/{id}', [DeliveryOrderController::class, "update_order"]);
  Route::get('completed-orders', [DeliveryOrderController::class, "completed_orders"]);
});
