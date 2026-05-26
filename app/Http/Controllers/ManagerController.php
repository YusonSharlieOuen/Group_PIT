<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Staff;
use App\Models\User;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $branchId = auth()->user()->staff->branch_id;

    $staffCount = Staff::where('branch_id', $branchId)->count();

    $supervisorCount = Staff::where('branch_id', $branchId)
        ->where('position', 'Supervisor')
        ->count();

    $staffMembers = Staff::where('branch_id', $branchId)
        ->orderBy('staff_id', 'desc')
        ->take(5)
        ->get();

    return view('manager.manager_dashboard', compact(
        'staffCount',
        'supervisorCount',
        'staffMembers'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = \App\Models\Branch::all();

        $supervisors = Staff::where('position', 'Supervisor')->get();

        return view('manager.create-staff', compact('branches', 'supervisors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'position' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',

        'email' => 'nullable|email|unique:users,email',
        'password' => 'nullable|confirmed|min:8',
    ]);

    $position = $request->position;

    /*
    |--------------------------------------------------------------------------
    | Generate Staff ID
    |--------------------------------------------------------------------------
    */

    if ($position === 'Supervisor') {

        // Get latest supervisor
        $latestSupervisor = Staff::where('staff_id', 'like', 'SPV%')
            ->orderByDesc('staff_id')
            ->first();

        if ($latestSupervisor) {
            $number = (int) str_replace('SPV', '', $latestSupervisor->staff_id);
            $staffId = 'SPV' . ($number + 1);
        } else {
            $staffId = 'SPV1';
        }

    } else {

        // Secretary + Staff use S
        $latestStaff = Staff::where('staff_id', 'like', 'S%')
            ->where('staff_id', 'not like', 'SPV%')
            ->orderByDesc('staff_id')
            ->first();

        if ($latestStaff) {
            $number = (int) str_replace('S', '', $latestStaff->staff_id);
            $staffId = 'S' . ($number + 1);
        } else {
            $staffId = 'S1';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Create Staff
    |--------------------------------------------------------------------------
    */

    Staff::create([
        'staff_id' => $staffId,
        'position' => $request->position,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'sex' => $request->sex,
        'date_of_birth' => $request->date_of_birth,
        'date_joined' => $request->date_joined,
        'nin' => $request->nin,
        'salary' => $request->salary,
        'branch_id' => auth()->user()->branch_id,
        'supervisor_id' => $request->supervisor_id,
        'address' => $request->address,
    ]);

    if ($request->filled('email') && $request->filled('password')) {

    User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),

        // your role system
        'user_type' => strtolower($request->position),

        // optional relation
        'staff_id' => $staffId,
        'branch_id' => auth()->user()->branch_id,
    ]);
    }

    return redirect()
        ->route('staff.index')
        ->with('success', 'Staff created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }
    public function showStaff($id)
    {
        $staff = Staff::with([
            'branch',
            'supervisor',
            'subordinates',
            'nextOfKin',
            'assignedProperties'
        ])->findOrFail($id);

        return view('manager.staff-details', compact('staff'));
    }

    public function staffIndex()
{
    $staffs = Staff::with('branch')
        ->where('branch_id', auth()->user()->branch_id)
        ->paginate(10);

    return view('manager.staff-view', compact('staffs'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
