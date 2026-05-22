<?php

namespace App\Http\Controllers;

use App\Models\PropertyDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // We need this to talk directly to PostgreSQL

class PropertyController extends Controller
{
    // Your existing Find a Home function...
    public function index(Request $request)
    {
        $properties = PropertyDetails::where('status', 'Available')
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
            ->get();

        return view('find-home', compact('properties'));
    }

    // THE MAGIC: Saving the List Your Property form
    public function store(Request $request)
    {
        // 1. Validate the form data so PostgreSQL doesn't crash
        $request->validate([
            'property_type' => 'required|string',
            'beds'          => 'required|integer|min:1',
            'baths'         => 'required|integer|min:1',
            'price'         => 'required|numeric',
            'address'       => 'required|string|max:100',
            'contact_name'  => 'required|string|max:100',
        ]);

        // 2. Generate custom String IDs (e.g., O_4829, P_9182)
        // Since your DB uses VARCHAR(10) for IDs, this keeps them unique and short
        $ownerId = 'O_' . rand(1000, 9999);
        $propertyId = 'P_' . rand(1000, 9999);

        // 3. Database Transaction
        // This ensures that if one insert fails, they ALL fail. No half-saved data!
        DB::transaction(function () use ($request, $ownerId, $propertyId) {
            
            // A. Create the Owner
            DB::table('owner')->insert([
                'owner_id'  => $ownerId,
                'full_name' => $request->contact_name,
                'address'   => 'See Property Address', // Defaulting since form doesn't separate owner address
                'phone'     => 'N/A', // Form asks for email, but DB asks for phone. Defaulting for now.
            ]);

            // B. Create the Property
            DB::table('property')->insert([
                'property_id'     => $propertyId,
                'street'          => $request->address, // Mapping the whole form address to street
                'area'            => 'Unspecified',     // Defaulting required DB column
                'city'            => 'Unspecified',     // Defaulting required DB column
                'postcode'        => 'N/A',             // Defaulting required DB column
                'property_type'   => $request->property_type,
                'number_of_rooms' => $request->beds + $request->baths, // Combining beds & baths!
                'monthly_rent'    => $request->price,
                'status'          => 'Available',
                'branch_id'       => 'B1', // Auto-assigning to Main St branch
                'staff_id'        => 'S1', // Auto-assigning to Alice (Manager)
            ]);

            // C. Link the Owner to the Property
            DB::table('property_owner')->insert([
                'property_id' => $propertyId,
                'owner_id'    => $ownerId,
            ]);
            
        });

        // 4. Send the user back with a success message!
        return redirect()->back()->with('success', 'Your property has been listed successfully!');
    }
}
