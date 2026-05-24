<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PropertyDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // We need this to talk directly to PostgreSQL

class PropertyController extends Controller
{
    // Your existing Find a Home function...
    public function index(Request $request)
    {
        $branches = Branch::orderBy('branch_id')->get();

        $properties = PropertyDetails::with('branch')
            ->where('status', 'Available')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('street', 'like', "%{$search}%")
                        ->orWhere('area', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('postcode', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('property_type', $request->type);
            })
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->get();

        return view('find-home', compact('properties', 'branches'));
    }

    // THE MAGIC: Saving the List Your Property form
    public function store(Request $request)
    {
        $request->validate([
            'property_type' => 'required|string',
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'address' => 'required|string|max:100',
            'contact_name' => 'required|string|max:100',
        ]);

        $ownerId = 'O_' . rand(1000, 9999);
        $propertyId = 'P_' . rand(1000, 9999);

        DB::transaction(function () use ($request, $ownerId, $propertyId) {
            DB::table('owner')->insert([
                'owner_id' => $ownerId,
                'full_name' => $request->contact_name,
                'address' => 'See Property Address',
                'phone' => 'N/A',
            ]);

            // IMPORTANT: create via Eloquent model so the same table/fields used by the client listing are populated.
            $property = \App\Models\PropertyDetails::create([
                'property_id' => $propertyId,
                'street' => $request->address,
                'area' => 'Unspecified',
                'city' => 'Unspecified',
                'postcode' => 'N/A',
                'property_type' => $request->property_type,
                'number_of_rooms' => $request->beds + $request->baths,
                'monthly_rent' => $request->price,
                'status' => 'Available',
                'photo_path' => null,
                // keep legacy defaults (ensure they exist in DB)
                'branch_id' => 'B1',
                'staff_id' => 'S1',
            ]);

            DB::table('property_owner')->insert([
                'property_id' => $property->property_id,
                'owner_id' => $ownerId,
            ]);
        });

        return redirect()->back()->with('success', 'Your property has been listed successfully!');
    }
}
