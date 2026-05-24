<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PropertyDetails;
use App\Models\Staff;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProperties = PropertyDetails::count();
        $available = PropertyDetails::where('status', 'Available')->count();
        $totalStaff = Staff::count();

        return view('admin.dashboard', compact('totalProperties', 'available', 'totalStaff'));
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_id')->get();

        return view('admin.create-staff', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'position' => ['required', 'string', 'max:20'],
            'branch_id' => ['nullable', 'exists:branch,branch_id'],
        ]);

        $validated['staff_id'] = $request->input('staff_id') ?: $this->nextStaffId();
        $validated['last_name'] = $validated['last_name'] ?? '';

        Staff::create($validated);

        return back()->with('success', 'Staff member created successfully.');
    }

    private function nextStaffId(): string
    {
        $lastId = Staff::query()
            ->where('staff_id', 'like', 'S%')
            ->orderByRaw("CAST(SUBSTRING(staff_id FROM 2) AS INTEGER) DESC")
            ->value('staff_id');

        $nextNumber = $lastId ? ((int) substr($lastId, 1)) + 1 : 1;

        return 'S'.$nextNumber;
    }
}
