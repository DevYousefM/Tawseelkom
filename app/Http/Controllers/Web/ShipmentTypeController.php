<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ShipmentType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShipmentTypeController extends Controller
{
    public function index()
    {
        $shipment_types = ShipmentType::all();
        return view("dashboard.pages.shipment_types.index", ["shipment_types" => $shipment_types]);
    }
    public function create()
    {
        return view("dashboard.pages.shipment_types.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|unique:shipment_types,title",
            "desc" => "required|max:100",
        ]);

        ShipmentType::create([
            "title" => $request->title,
            "desc" => $request->desc
        ]);

        return redirect()->route("shipment_types")->with("success", "تم اضافة نوع الشحنة");
    }
    public function edit($id)
    {
        $shipment_type = ShipmentType::findOrFail($id);
        return view("dashboard.pages.shipment_types.edit", ["shipment_type" => $shipment_type]);
    }
    public function update(Request $request, $id)
    {
        $shipment_type = ShipmentType::findOrFail($id);

        $request->validate([
            "title" => ["required", Rule::unique("shipment_types")->ignore($id)],
            "desc" => "required|max:100",
        ]);

        $shipment_type->update([
            "title" => $request->title,
            "desc" => $request->desc
        ]);

        return redirect()->back()->with("type_updated", "تم تحديث نوع الشحنة");
    }
    public function delete($id)
    {
        $shipment_type = ShipmentType::findOrFail($id);
        $shipment_type->delete();
        return redirect()->route("shipment_types")->with("success", "تم حذف نوع الشحنة");
    }
}
