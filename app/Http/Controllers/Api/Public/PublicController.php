<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\ShipmentTypeResource;
use App\Models\Area;
use App\Models\ShipmentType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    use ApiResponse;
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
}
