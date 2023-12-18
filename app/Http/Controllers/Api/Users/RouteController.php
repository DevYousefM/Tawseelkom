<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    use ApiResponse;
    public function get_routes()
    {
        $routes = Route::whereNptNull("price")->get();
        return $this->apiResponse("routes", $routes, "المسارات", 200);
    }
}
