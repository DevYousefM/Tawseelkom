<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;
    public function get_routes()
    {
        $routes = Route::whereNotNull("price")->get();
        return $this->apiResponse("routes", $routes, "المسارات", 200);
    }
    public function single_route(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "from_area_id" => "required|exists:areas,id",
            "to_area_id" => "required|exists:areas,id",
            "shipment_type_id" => "required|exists:shipment_types,id",
        ]);
        if ($validator->fails()) {
            return $this->apiResponse("errors", $this->errorsResponse($validator), "Validation Error", 422);
        }
        $route = Route::where("from_area_id", $request->from_area_id)->where("to_area_id", $request->to_area_id)->where("shipment_type_id", $request->shipment_type_id)->first();
        return $this->apiResponse("route", $route, "بيانات المسار", 200);
    }
}
