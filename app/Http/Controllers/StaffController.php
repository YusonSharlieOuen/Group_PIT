<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\NextOfKin;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with(['branch', 'supervisor', 'nextOfKin'])
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
        $validated = $request->validate([
            'staff_id' => ['required', 'string', 'max:10', 'unique:staff,staff_id'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'sex' => ['nullable', 'string', 'max:10'],
            'date_of_birth' => ['nullable', 'date'],
            'nin' => ['nullable', 'string', 'max:20'],
            'position' => ['required', 'string', 'max:20'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'date_joined' => ['nullable', 'date'],
            'branch_id' => ['nullable', 'exists:branch,branch_id'],
            'supervisor_id' => ['nullable', 'exists:staff,staff_id', 'different:staff_id'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validated['email'] && empty($validated['password'])) {
            return back()->withInput()->withErrors(['password' => 'Password is required when email is provided.']);
        }

        $staffData = collect($validated)->except(['email', 'password', 'password_confirmation'])->toArray();
        $staff = Staff::create($staffData);

        if (! empty($validated['email'])) {
            $user = User::create([
                'name' => $validated['first_name'].' '.$validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $staff->user_id = $user->id;
            $staff->save();
        }

        return redirect()
            ->route('staff.show', $staff->staff_id)
            ->with('success', 'Staff created successfully.');
    }

    public function show($id)
    {
        $staff = Staff::with(['branch', 'supervisor', 'subordinates', 'nextOfKin', 'assignedProperties'])
            ->findOrFail($id);

        return view('staff_details.staff_details', compact('staff'));
    }

    /*
    NEXT OF KIN
    */

    public function createNextOfKin($id)
    {
        $staff = Staff::findOrFail($id);

        /*
        Prevent duplicate next of kin
        */

        if ($staff->nextOfKin) {
            return back()->with('error', 'Next of kin already exists.');
        }

        return view('staff_details.edit_next_of_kin', compact('staff'));
    }

    public function storeNextOfKin(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

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
        $staff = Staff::findOrFail($id);
        $branches = Branch::orderBy('branch_id')->get();
        $supervisors = Staff::where('staff_id', '!=', $id)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('staff_details.edit_staff', compact('staff', 'branches', 'supervisors'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'sex' => ['nullable', 'string', 'max:10'],
            'date_of_birth' => ['nullable', 'date'],
            'nin' => ['nullable', 'string', 'max:20'],
            'position' => ['required', 'string', 'max:20'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'date_joined' => ['nullable', 'date'],
            'branch_id' => ['nullable', 'exists:branch,branch_id'],
            'supervisor_id' => [
                'nullable',
                Rule::exists('staff', 'staff_id'),
                Rule::notIn([$staff->staff_id]),
            ],
        ]);

        $staff->update($validated);

        return redirect()
            ->route('staff.show', $id)
            ->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);

        if ($staff->user) {
            $staff->user->delete();
        }

        $staff->delete();

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff deleted successfully.');
    }
}
