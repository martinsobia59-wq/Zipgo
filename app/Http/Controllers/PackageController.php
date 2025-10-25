<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Package::query();

        // Filtering
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_number', 'like', "%{$search}%")
                    ->orWhere('recipient_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sorting
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        // Whitelist allowed sortable columns
        if (!in_array($sort, ['created_at', 'tracking_number', 'recipient_name'])) {
            $sort = 'created_at';
        }

        $query->orderBy($sort, $direction);

        // Pagination
        $packages = $query->paginate(10)->withQueryString();

        return inertia('Packages/Index', [
            'packages' => $packages,
            'filters' => $request->only(['search', 'status', 'sort', 'direction']),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Packages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|string',
        ]);

        $package = Package::create($validated);

        $package->locations()->create([
            'message' => 'Package label created',
        ]);

        return redirect()->route('packages.index')
            ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = Package::with('locations')->findOrFail($id);

        return Inertia::render('Packages/View', [
            'package' => $package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     **/
    public function edit(string $id)
    {
        $package = Package::findOrFail($id);

        return inertia('Packages/Edit', [
            'package' => $package,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $package = Package::findOrFail($id);
        $package->update($validated);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
