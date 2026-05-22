<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\PropertyDetails;
use App\Models\Renter;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Lease.create_lease');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*
        AUTO GENERATE LEASE ID
        */

        $number = 1;

        do {

            $leaseId = 'L'.$number;

            $exists = Lease::where('lease_id', $leaseId)->exists();

            $number++;

        } while ($exists);

        /*
        GET DROPDOWN DATA
        */

        $properties = PropertyDetails::where(
            'status',
            'Available'
        )->get();

        $renters = Renter::all();

        $staff = Staff::all();

        return view('Lease.create_lease', compact(
            'leaseId',
            'properties',
            'renters',
            'staff'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lease_id' => 'required|unique:lease,lease_id',

            'property_id' => 'required',
            'renter_id' => 'required',
            'staff_id' => 'required',

            'rent' => 'required|numeric',
            'deposit' => 'required|numeric',

            'payment_method' => 'required',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        /*
        CALCULATE DURATION
        */

        $start = strtotime($request->start_date);

        $end = strtotime($request->end_date);

        $duration = ($end - $start) / (60 * 60 * 24 * 30);

        $property = PropertyDetails::findOrFail($request->property_id);

        Lease::create([
            'lease_id' => $request->lease_id,

            'property_id' => $request->property_id,
            'renter_id' => $request->renter_id,
            'staff_id' => $request->staff_id,

            'rent' => $property->monthly_rent,
            'deposit' => $request->deposit,

            'deposit_paid' => $request->deposit_paid ?? false,

            'payment_method' => $request->payment_method,

            'start_date' => $request->start_date,
            'end_date' => $request->end_date,

            'duration' => round($duration),
        ]);

        return back()->with(
            'success',
            'Lease created successfully.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Lease $lease) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lease $lease)
    {
        //
    }
}
