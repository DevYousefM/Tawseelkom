<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Route;
use App\Models\ShipmentType;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::orderByRaw('price = 0 asc')->get();
        return view("dashboard.pages.routes.index", ["routes" => $routes]);
    }
    public function refresh()
    {
        $areas = Area::all();
        $shipment_types = ShipmentType::all();

        foreach ($areas as $fromArea) {
            foreach ($areas as $toArea) {
                foreach ($shipment_types as $type) {
                    $check_exist = Route::where("from_area_id", $fromArea->id)->where("to_area_id", $toArea->id)->where("shipment_type_id", $type->id)->get();
                    if (count($check_exist) === 0) {
                        Route::create([
                            'from_area_id' => $fromArea->id,
                            'to_area_id' => $toArea->id,
                            'shipment_type_id' => $type->id,
                            'price' => 10,
                            'distance' => 1,
                        ]);
                    }
                }
            }
        }
        return redirect()->route("routes")->with("success", "تم تحديث المسارات");
    }
    public function update_price(Request $request, $id)
    {
        $route = Route::findOrFail($id);
        if (!empty($request->price) && $request->price > 0 && is_numeric($request->price)) {
            $route->update([
                "price" => $request->price
            ]);
        }
        return redirect()->back();
    }
    public function update_distance(Request $request, $id)
    {
        $route = Route::findOrFail($id);
        if (!empty($request->distance) && $request->distance > 0 && is_numeric($request->distance)) {
            $route->update([
                "distance" => $request->distance
            ]);
        }
        return redirect()->back();
    }
}
