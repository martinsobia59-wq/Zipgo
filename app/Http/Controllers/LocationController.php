<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Location;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function store(Request $request, Package $package)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $package->locations()->create($validated);

        return back()->with('success', 'Location added successfully.');
    }

    public function index($packageId)
    {
        $package = Package::with('locations')->findOrFail($packageId);

        return Inertia::render('Locations/Index', [
            'package' => [
                'id' => $package->id,
                'tracking_number' => $package->tracking_number,
                'recipient_name' => $package->recipient_name,
                'locations' => $package->locations->map(fn($loc) => [
                    'id' => $loc->id,
                    'message' => $loc->message,
                    'created_at' => $loc->created_at->toDateTimeString(),
                ]),
            ],
        ]);
    }

    public function destroy($packageId, $locationId)
    {
        $location = Location::where('package_id', $packageId)
            ->where('id', $locationId)
            ->firstOrFail();

        $location->delete();

        return redirect()->route('packages.locations.index', $packageId)
            ->with('success', 'Location deleted successfully.');
    }
}
