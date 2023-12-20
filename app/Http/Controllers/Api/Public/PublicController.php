<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\ShipmentTypeResource;
use App\Models\Area;
use App\Models\Route;
use App\Models\ShipmentType;
use App\Traits\ApiResponse;
use App\Traits\ErrorsResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    use ApiResponse;
    use ErrorsResponse;
    public function areas()
    {
        $areas = Area::all();
        return $this->apiResponse("areas", AreaResource::collection($areas), "جميع المراكز", 200);
    }
    public function shipment_types()
    {
        $shipment_types = ShipmentType::all();
        return $this->apiResponse("shipment_types", ShipmentTypeResource::collection($shipment_types), "انواع الشحنات", 200);
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
