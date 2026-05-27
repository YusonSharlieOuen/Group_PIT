<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Property;
use App\Models\PropertyDetails;
use App\Models\Renter;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Private helper to fetch data required by the Create/Edit Lease views.
     */
    private function getFormData()
    {
        return [
            'properties' => PropertyDetails::where('status', 'Available')->get(),
            'renters'    => Renter::all(),
            'staff'      => Staff::orderBy('first_name')->get(),
            'leaseId'    => 'L-' . now()->format('YmdHis'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For admins we show the lease table
        // (Staff can view via staff-dashboard)
        $leases = Lease::with(['property', 'renter', 'staff'])->get();
        return view('Admin.leases.index', ['leases' => $leases]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Lease.create_lease', $this->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lease_id' => 'required|unique:lease,lease_id',
            'property_id' => 'required|exists:property,property_id',
            'renter_id' => 'required|exists:renter,renter_id',
            'staff_id' => 'required|exists:staff,staff_id',
            'rent' => 'required|numeric',
            'deposit' => 'required|numeric',
            'payment_method' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = strtotime($request->start_date);
        $end = strtotime($request->end_date);
        $duration = ($end - $start) / (60 * 60 * 24 * 30);

        // Fallback to avoid crashes if PropertyDetails vs Property models are mixed
        $property = PropertyDetails::find($request->property_id) ?? Property::where('property_id', $request->property_id)->firstOrFail();
        $rentAmount = $property->monthly_rent ?? $request->rent;

        // Postgres columns are varchar(10) for ids and lease_id.
        // Truncate to 10 chars and ensure uniqueness to avoid 23505 duplicate key errors.
        $baseLeaseId = substr((string) $request->lease_id, 0, 10);
        if ($baseLeaseId === '') {
            $baseLeaseId = 'L' . now()->format('Ymd');
            $baseLeaseId = substr($baseLeaseId, 0, 10);
        }

        $leaseId = $baseLeaseId;
        $i = 1;
        while (Lease::where('lease_id', $leaseId)->exists()) {
            $suffix = '-' . $i;
            $leaseId = substr($baseLeaseId, 0, max(0, 10 - strlen($suffix))) . $suffix;
            $i++;
            if ($i > 50) {
                $leaseId = substr('L-' . now()->format('YmdHis'), 0, 10);
                break;
            }
        }

        $propertyId = (string) $request->property_id;
        $propertyId = substr($propertyId, 0, 10);

        $renterId = (string) $request->renter_id;
        $renterId = substr($renterId, 0, 10);

        $staffId = (string) $request->staff_id;
        $staffId = substr($staffId, 0, 10);

        Lease::create([
            'lease_id' => $leaseId,
            'property_id' => $propertyId,
            'renter_id' => $renterId,
            'staff_id' => $staffId,
            'rent' => $rentAmount,
            'deposit' => $request->deposit,
            'deposit_paid' => $request->has('deposit_paid') ? true : false,
            'payment_method' => $request->payment_method,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => round($duration),
        ]);


        return redirect()
            ->route('lease.create')
            ->with('success', 'Lease created successfully.');
    }

    public function display_all_leases()
    {
        $leases = Lease::with(['property', 'renter', 'staff'])->get();
        return view('Lease.display_all_lease', compact('leases'));
    }

    public function show($id)
    {
        $leaseId = $id instanceof Lease ? $id->lease_id : $id;
        $lease = Lease::where('lease_id', $leaseId)->firstOrFail();

        return view('Lease.show_lease', compact('lease'));
    }
    
    /**
     * Show the edit form for the specific lease record.
     */
    public function edit($lease)
    {
        $leaseId = $lease instanceof Lease ? $lease->lease_id : $lease;
        $leaseData = Lease::where('lease_id', $leaseId)->firstOrFail();

        $formData = $this->getFormData();
        return view('Lease.edit_lease', array_merge(['lease' => $leaseData], $formData));
    }
    
    /**
     * Update the specified lease record in storage.
     */
    public function update(Request $request, $id)
    {
        $leaseId = $id instanceof Lease ? $id->lease_id : $id;
        $lease = Lease::where('lease_id', $leaseId)->firstOrFail();

        $request->validate([
            'property_id' => 'required|exists:property,property_id',
            'renter_id' => 'required|exists:renter,renter_id',
            'staff_id' => 'required|exists:staff,staff_id',
            'rent' => 'required|numeric',
            'deposit' => 'required|numeric',
            'payment_method' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start = strtotime($request->start_date);
        $end = strtotime($request->end_date);
        $duration = ($end - $start) / (60 * 60 * 24 * 30);

        $lease->property_id = $request->property_id;
        $lease->renter_id = $request->renter_id;
        $lease->staff_id = $request->staff_id;
        $lease->rent = $request->rent;
        $lease->deposit = $request->deposit;
        $lease->deposit_paid = $request->has('deposit_paid') ? true : false;
        $lease->payment_method = $request->payment_method;
        $lease->start_date = $request->start_date;
        $lease->end_date = $request->end_date;
        $lease->duration = round($duration);
        $lease->save();

        return redirect()
            ->route('lease.display_all_leases')
            ->with('success', 'Lease updated successfully.');
    }
    
    /**
     * Remove the specified lease record from storage.
     */
    public function destroy($id)
    {
        $leaseId = $id instanceof Lease ? $id->lease_id : $id;
        $lease = Lease::where('lease_id', $leaseId)->firstOrFail();
        
        $lease->delete();

        return redirect()
            ->route('lease.display_all_leases')
            ->with('success', 'Lease deleted successfully.');
    }
}