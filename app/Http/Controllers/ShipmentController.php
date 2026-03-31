<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $shipments = Shipment::query()
            ->when($request->search, fn($q, $s) =>
                $q->where('tracking_number', 'like', "%$s%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('shipments.index', compact('shipments'));
    }

    public function show(Shipment $shipment)
    {
        $shipment->load(['statusLogs' => fn($q) => $q->orderBy('created_at')]);

        return view('shipments.show', compact('shipment'));
    }
}
