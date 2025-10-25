<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrackingController extends Controller
{
    public function track()
    {
        return Inertia::render('Tracking/Index');
    }

    /**
     * Track a package by tracking number (API-style endpoint).
     */
    public function show(string $trackingNumber)
    {
        $pkg = Package::with('locations')
            ->where('tracking_number', $trackingNumber)
            ->first();

        return Inertia::render('Tracking/Index', [
            'pkg' => $pkg,
        ]);
    }
}
