<?php

use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DeliveryController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\RouteController;
use App\Http\Controllers\Web\ShipmentTypeController;
use App\Http\Resources\OrderDashResource;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, "login_form"])->name("dashboard.login.form");
Route::post('/login', [AuthController::class, "login"])->name("login");

Route::middleware(['is.admin'])->group(function () {
  // Admin Routes
  Route::get('/logout', [AuthController::class, "logout"])->name("logout");
  Route::get('/', [AuthController::class, "index"])->name("dashboard");
  Route::get('/profile', [AuthController::class, "profile"])->name("profile");
  Route::post('/update-info/{id}', [AuthController::class, "update_information"])->name("update_information.admin");
  Route::post('/update-password/{id}', [AuthController::class, "update_password"])->name("update_password.admin");

  Route::prefix('deliveries')->group(function () {
    Route::get('/', [DeliveryController::class, "index"])->name("deliveries");
    Route::get('/add', [DeliveryController::class, "create"])->name("add.deliveries");
    Route::post('/store', [DeliveryController::class, "store"])->name("store.deliveries");
    Route::get('/edit/{id}', [DeliveryController::class, "edit"])->name("edit.deliveries");
    Route::post('/update-info/{id}', [DeliveryController::class, "update_information"])->name("update_information.deliveries");
    Route::post('/update-password/{id}', [DeliveryController::class, "update_password"])->name("update_password.deliveries");
    Route::delete('/delete/{id}', [DeliveryController::class, "delete"])->name("delete.deliveries");
  });
  Route::prefix('areas')->group(function () {
    Route::get('/', [AreaController::class, "index"])->name("areas");
    Route::get('/add', [AreaController::class, "create"])->name("add.areas");
    Route::post('/store', [AreaController::class, "store"])->name("store.areas");
    Route::get('/edit/{id}', [AreaController::class, "edit"])->name("edit.areas");
    Route::post('/update/{id}', [AreaController::class, "update"])->name("update.areas");
    Route::delete('/delete/{id}', [AreaController::class, "delete"])->name("delete.areas");
  });
  Route::prefix('shipment-types')->group(function () {
    Route::get('/', [ShipmentTypeController::class, "index"])->name("shipment_types");
    Route::get('/add', [ShipmentTypeController::class, "create"])->name("add.shipment_types");
    Route::post('/store', [ShipmentTypeController::class, "store"])->name("store.shipment_types");
    Route::get('/edit/{id}', [ShipmentTypeController::class, "edit"])->name("edit.shipment_types");
    Route::post('/update/{id}', [ShipmentTypeController::class, "update"])->name("update.shipment_types");
    Route::delete('/delete/{id}', [ShipmentTypeController::class, "delete"])->name("delete.shipment_types");
  });
  Route::prefix('routes')->group(function () {
    Route::get('/', [RouteController::class, "index"])->name("routes");
    Route::get('/refresh-routes', [RouteController::class, "refresh"])->name("refresh.routes");
    Route::post('/update-price/{id}', [RouteController::class, "update_price"])->name("update.route.price");
    Route::post('/update-distance/{id}', [RouteController::class, "update_distance"])->name("update.route.distance");
  });
  Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, "index"])->name("orders");
    Route::get('/json', function () {
      $orders = UserOrder::with('delivery_order')->with("user")->get();
      return OrderDashResource::collection($orders);
    });
  });
});
