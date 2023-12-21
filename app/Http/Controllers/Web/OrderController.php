<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDashResource;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = UserOrder::with('delivery_order')->with("user")->get();
        return view("dashboard.pages.orders.index", ["orders" => OrderDashResource::collection($orders)]);
    }
}
