<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PropertyDetails;
use App\Models\Staff;
use App\Models\Viewing;
use Illuminate\Http\Request;

class PropertyDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $properties = PropertyDetails::all();

        $query = PropertyDetails::query();

        if ($request->filter == 'available') {
            $query->where('status', 'Available');
        }

        $properties = $query->get();

        return view(
            'Property.index',
            compact('properties')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $number = 1;

        do {
            $propertyId = 'P'.$number;

            $exists = PropertyDetails::where('property_id', $propertyId)->exists();

            $number++;

        } while ($exists);

        $branches = Branch::all();

        $staff = Staff::where('position', 'Staff')->get();

        return view('Property.create_property', compact(
            'propertyId',
            'branches',
            'staff'
        ));
    }

    public function getStaffByBranch($branch_id)
    {
        $staff = Staff::where('branch_id', $branch_id)
            ->where('position', 'Staff')
            ->get();

        return response()->json($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|unique:property,property_id',
            'street' => 'required',
            'area' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'property_type' => 'required',
            'number_of_rooms' => 'required|integer',
            'monthly_rent' => 'required|numeric',
            'branch_id' => 'nullable|exists:branch,branch_id',
            'staff_id' => 'nullable|exists:staff,staff_id',
        ]);

        PropertyDetails::create([
            'property_id' => $request->property_id,
            'street' => $request->street,
            'area' => $request->area,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'property_type' => $request->property_type,
            'number_of_rooms' => $request->number_of_rooms,
            'monthly_rent' => $request->monthly_rent,
            'status' => 'Available',
            'branch_id' => $request->branch_id ?? null,
            'staff_id' => $request->staff_id ?? null,
        ]);

        return redirect()
            ->route('property.index')
            ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $property = PropertyDetails::find($id);

        $property = PropertyDetails::findOrFail($id);

        $viewings = Viewing::where('property_id', $id)->get();

        $renters = Renter::all();

        // dd($property);

        return view(
            'Property.show_property',
            compact('property', 'viewings', 'renters')
        );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyDetails $propertyDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyDetails $propertyDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyDetails $propertyDetails)
    {
        //
    }
}
