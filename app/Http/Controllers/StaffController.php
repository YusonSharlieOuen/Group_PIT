<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\NextOfKin;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
    private function ensureUniqueStaffId(?string $providedStaffId): string
    {
        if (! empty($providedStaffId) && ! Staff::where('staff_id', $providedStaffId)->exists()) {
            return $providedStaffId;
        }

        // FIXED FOR POSTGRESQL: Replaced mysql 'UNSIGNED' casting with standard 'INTEGER' casting blocks
        $lastId = Staff::query()
            ->whereNotNull('staff_id')
            ->orderByRaw("CAST(REGEXP_SUBSTR(staff_id, '[0-9]+') AS INTEGER) DESC")
            ->value('staff_id');

        if ($lastId === null) {
            $lastId = Staff::query()->orderByDesc('staff_id')->value('staff_id');
        }

        $num = preg_match('/([0-9]+)$/', (string) $lastId, $m) ? (int) $m[1] : 0;
        $nextNum = $num + 1;

        $prefix = '';
        if (! empty($providedStaffId)) {
            $prefix = preg_replace('/[0-9]+$/', '', (string) $providedStaffId);
        }
        if (empty($prefix)) {
            $prefix = preg_replace('/[0-9]+$/', '', (string) $lastId);
        }
        if (empty($prefix)) {
            $prefix = 'S';
        }

        return $prefix . $nextNum;
    }

    

    public function index()
    {
        $staffs = Staff::with([
                'branch',
                'supervisor',
                'nextOfKin',
            ])
            ->orderBy('staff_id')
            ->paginate(5)
            ->withQueryString();

        return view('staff_details.index', compact('staffs'));
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_id')->get();
        $supervisors = Staff::orderBy('first_name')->orderBy('last_name')->get();

        return view('staff_details.create_staff', compact('branches', 'supervisors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:50'],
        'last_name' => ['required', 'string', 'max:50'],
        'position' => ['required', Rule::in(['Manager', 'Supervisor', 'Staff'])],

        // Optional login account
        'email' => ['nullable', 'email', 'unique:users,email'],
        'password' => ['nullable', 'confirmed', 'min:6'],
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | Generate Staff ID Based on Position
        |--------------------------------------------------------------------------
        */

        $position = $request->position;

        $prefix = match ($position) {
            'Manager' => 'M',
            'Supervisor' => 'SPV',
            default => 'S',
        };

        $latestStaff = Staff::where('staff_id', 'LIKE', $prefix . '%')
            ->orderByRaw("CAST(REGEXP_SUBSTR(staff_id, '[0-9]+') AS INTEGER) DESC")
            ->first();

        $nextNumber = 1;

        if ($latestStaff) {
            preg_match('/([0-9]+)$/', $latestStaff->staff_id, $matches);

            if (isset($matches[1])) {
                $nextNumber = (int) $matches[1] + 1;
            }
        }

        $staffId = $prefix . $nextNumber;

        /*
        |--------------------------------------------------------------------------
        | Create User Account (Optional)
        |--------------------------------------------------------------------------
        */

        $user = null;

        if ($request->filled('email') && $request->filled('password')) {

            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

                // Set role automatically
                'user_type' => strtolower($position),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Format Sex
        |--------------------------------------------------------------------------
        */

        $sex = $request->input('sex');

        if (in_array($sex, ['Male', 'Female'])) {
            $sex = ($sex === 'Male') ? 'M' : 'F';
        }

        /*
        |--------------------------------------------------------------------------
        | Create Staff
        |--------------------------------------------------------------------------
        */

        $staff = new Staff();

        $staff->staff_id = $staffId;

        // Link created user account
        $staff->user_id = $user?->id;

        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->position = $position;

        $staff->sex = $sex;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->date_joined = $request->date_joined;
        $staff->salary = $request->salary;

        $staff->branch_id = $request->branch_id;
        $staff->phone = $request->phone;

        if (Schema::hasColumn('staff', 'mobile')) {
            $staff->mobile = $request->mobile;
        }

        $staff->nin = $request->nin;
        $staff->supervisor_id = $request->supervisor_id;
        $staff->address = $request->address;

        $staff->save();

        DB::commit();

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff created successfully.');

    } catch (\Throwable $e) {

        DB::rollBack();

        return back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}

    public function show($id)
    {
        $staff = Staff::where('staff_id', $id)->firstOrFail();
        return view('staff_details.staff_details', compact('staff'));
    }

    public function createNextOfKin($id)
    {
        $staff = Staff::where('staff_id', $id)->firstOrFail();

        if ($staff->nextOfKin) {
            return back()->with('error', 'Next of kin already exists.');
        }

        return view('staff_details.edit_next_of_kin', compact('staff'));
    }

    public function storeNextOfKin(Request $request, $id)
    {
        $staff = Staff::where('staff_id', $id)->firstOrFail();

        if ($staff->nextOfKin) {
            return back()->with('error', 'Next of kin already exists.');
        }

        $request->validate([
            'full_name' => 'required',
            'relationship' => 'required',
        ]);

        NextOfKin::create([
            'staff_id' => $staff->staff_id,
            'full_name' => $request->full_name,
            'relationship' => $request->relationship,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()
            ->route('staff.show', $id)
            ->with('success', 'Next of kin added.');
    }

    public function edit($id)
    {
        $staff = Staff::where('staff_id', $id)->firstOrFail();
        $branches = Branch::orderBy('branch_id')->get();
        $supervisors = Staff::where('staff_id', '!=', $id)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('staff_details.edit_staff', compact('staff', 'branches', 'supervisors'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::where('staff_id', $id)->firstOrFail();

        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'position' => ['required', 'string', 'max:20'],
        ]);

        $sex = $request->input('sex');
        if (in_array($sex, ['Male', 'Female'])) {
            $sex = ($sex === 'Male') ? 'M' : 'F';
        }

        $staff->first_name = $request->input('first_name');
        $staff->last_name = $request->input('last_name');
        $staff->position = $request->input('position');
        $staff->sex = $sex;
        $staff->date_of_birth = $request->input('date_of_birth');
        $staff->date_joined = $request->input('date_joined');
        $staff->salary = $request->input('salary');
        $staff->branch_no = $request->input('branch_no') ?? $request->input('branch_id');
        $staff->telephone = $request->input('telephone') ?? $request->input('phone');
        $staff->mobile = $request->input('mobile');
        $staff->nin = $request->input('nin');
        $staff->supervisor_id = $request->input('supervisor_id');
        $staff->address = $request->input('address');
        $staff->save();

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        // 1. Find the staff record
        $staff = Staff::where('staff_id', $id)->firstOrFail();

        // 2. Fix: Only attempt to delete the user if a relationship exists
        // Replace 'user_id' below with the actual column in your 'users' table 
        // that matches the staff's identifier (or 'id' if the IDs are the same).
        // If the users table has no relationship to this staff, delete the line below.
        
        // Example: User::where('id', $staff->id)->delete(); 
        
        // For now, if you are unsure of the column, this will stop the crash:
        // User::where('staff_id', (string)$staff->staff_id)->delete(); 

        // 3. Delete dependent records first (leases), then delete staff.
        // This matches the admin policy chosen: deleting staff should delete their leases.
        try {
            // Delete leases that reference this staff
            \App\Models\Lease::where('staff_id', $staff->staff_id)->delete();

            $staff->delete();
        } catch (\Throwable $e) {
            return redirect()
                ->route('staff.index')
                ->with('error', 'Cannot delete staff member due to database constraints.');
        }


        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff deleted successfully.');
    }
}

