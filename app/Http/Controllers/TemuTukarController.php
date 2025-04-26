<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TemuTukarController extends Controller
{
    public function index(Request $request)
    {
        // Get user current location (from request or session or default to Bogor)
        $userCurrentLocation = (object)[
            'latitude' => $request->input('lat', -6.5971),
            'longitude' => $request->input('lng', 106.8060)
        ];

        // Get items with distance calculation
        $items = $this->getItemsWithDistance($userCurrentLocation);
        
        // Get institutions with distance calculation
        $institutions = $this->getInstitutionsWithDistance($userCurrentLocation);

        return view('pages.temutukar.index', compact(
            'userCurrentLocation',
            'items',
            'institutions'
        ));
    }

    private function getItemsWithDistance($userLocation)
    {
        // Calculate distance using the Haversine formula with MySQL
        return Item::select(
                'items.*',
                DB::raw("(
                    6371 * acos(
                        cos(radians({$userLocation->latitude})) * 
                        cos(radians(ST_Y(positions))) * 
                        cos(radians(ST_X(positions)) - radians({$userLocation->longitude})) + 
                        sin(radians({$userLocation->latitude})) * 
                        sin(radians(ST_Y(positions)))
                    )
                ) AS distance")
            )
            ->with('user')
            ->orderBy('distance')
            ->get();
    }

    private function getInstitutionsWithDistance($userLocation)
    {
        // Calculate distance using the Haversine formula with MySQL
        return Institution::select(
                'institutions.*',
                DB::raw("(
                    6371 * acos(
                        cos(radians({$userLocation->latitude})) * 
                        cos(radians(ST_Y(positions))) * 
                        cos(radians(ST_X(positions)) - radians({$userLocation->longitude})) + 
                        sin(radians({$userLocation->latitude})) * 
                        sin(radians(ST_Y(positions)))
                    )
                ) AS distance")
            )
            ->orderBy('distance')
            ->get();
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');
        $userCurrentLocation = (object)[
            'latitude' => $request->input('lat', -6.5971),
            'longitude' => $request->input('lng', 106.8060)
        ];

        $items = $this->getItemsWithDistance($userCurrentLocation);
        
        if ($category !== 'Semua Kategori') {
            $items = $items->where('category', $category);
        }
        
        return response()->json($items);
    }

    public function filterByDistance(Request $request)
    {
        $range = $request->input('range');
        $userCurrentLocation = (object)[
            'latitude' => $request->input('lat', -6.5971),
            'longitude' => $request->input('lng', 106.8060)
        ];

        $items = $this->getItemsWithDistance($userCurrentLocation);
        $institutions = $this->getInstitutionsWithDistance($userCurrentLocation);
        
        // Parse range and filter items
        if ($range === '1 km - 5 km') {
            $items = $items->whereBetween('distance', [1, 5]);
            $institutions = $institutions->whereBetween('distance', [1, 5]);
        } else if ($range === '6 km - 10 km') {
            $items = $items->whereBetween('distance', [6, 10]);
            $institutions = $institutions->whereBetween('distance', [6, 10]);
        } else if ($range === '11 km - 15 km') {
            $items = $items->whereBetween('distance', [11, 15]);
            $institutions = $institutions->whereBetween('distance', [11, 15]);
        }
        
        return response()->json([
            'items' => $items,
            'institutions' => $institutions
        ]);
    }
}