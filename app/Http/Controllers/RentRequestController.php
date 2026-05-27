<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentRequest;
use App\Models\Staff;

class RentRequestController extends Controller
{
    public function store($propertyId)
    {
        $user = auth()->user();

        $renter = $user->renter;

        RentRequest::create([
            'renter_id' => $renter->renter_id,
            'property_id' => $propertyId,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Rent request submitted');

    }

    public function assign(Request $request, RentRequest $rentRequest)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,staff_id',
        ]);

        $rentRequest->assigned_staff_id = $request->staff_id;
        $rentRequest->status = 'Assigned';
        $rentRequest->save();

        return back()->with('success', 'Staff assigned successfully.');
    }

    public function accept(RentRequest $rentRequest)
    {
        $staff = Staff::where('user_id', auth()->id())->first();
    
        $rentRequest->status = 'Accepted';
        $rentRequest->save();

        return back()->with('success', 'Rent request accepted.');
    }

    public function staffRequestsTest()
{
    return response()->json([
        'status' => 'route works',
        'user' => auth()->user(),
    ]);
}

    public function myRequests()
    {
        $renter = auth()->user()->renter;

        $requests = RentRequest::with([
            'property',
            'assignedStaff',
            'approver',
        ])

        ->where('renter_id', $renter->renter_id)
        ->get();

        return view('rent_requests.my_requests', compact('requests'));
    }

    public function staffRequests()
    {
        
        $user = auth()->user();

        $staff = Staff::where('user_id', $user->id)->first();

        if (! $staff) {
            abort(403, 'No staff record found.');
        }

        $requests = RentRequest::with([
            'renter',
            'property',
        ])
        ->where('assigned_staff_id', $staff->staff_id)
        ->get();

        return view('rent_requests.staff_requests', compact('requests'));

    }

    public function managerRequests()
    {
        $requests = RentRequest::with([
            'renter',
            'property',
            'assignedStaff',
        ])
        ->where('status', 'Pending')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('rent_requests.manager_requests', compact('requests'));
    }

    public function staffApprove(RentRequest $rentRequest)
{
    $staff = Staff::where('user_id', auth()->id())->first();

    // safety check: ensure this request belongs to this staff
    if ($rentRequest->assigned_staff_id !== $staff->staff_id) {
        abort(403, 'Not allowed');
    }

    // only allow pending/assigned requests
    if (! in_array($rentRequest->status, ['Assigned', 'Pending'])) {
        return back()->with('error', 'Request already processed.');
    }

    $rentRequest->status = 'Accepted';
    $rentRequest->approved_by = $staff->staff_id; // optional but good practice
    $rentRequest->save();

    return back()->with('success', 'Rent request approved successfully.');
}
}
