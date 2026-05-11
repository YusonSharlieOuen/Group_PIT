<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\NextOfKin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function create()
    {
        return view('staff_details.create_staff');

        if(
            auth()->user()->user_type != 'admin' &&
            auth()->user()->user_type != 'manager'
        ){
            abort(403);
        }

        return view('staff_details.create_staff');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

            'staff_id' => 'required|unique:staff,staff_id',
            'first_name' => 'required',
            'last_name' => 'required',

            'phone' => 'nullable|max:20',

            'salary' => 'nullable|numeric|min:0',

            'position' => 'required',

            'user_type' => 'required'
        ]);

        if(
            auth()->user()->user_type != 'admin' &&
            auth()->user()->user_type != 'manager'
        ){
            abort(403);
        }

        return view('staff_details.create_staff');

        /*
        Only admin can create manager
        */

        if (
            $request->position == 'Manager'
            && auth()->user()->user_type != 'admin'
        ) {
            return back()->with('error', 'Only admin can assign Manager.');
        }

        if(
            $request->user_type == 'manager' &&
            auth()->user()->user_type != 'admin'
        ){
            return back()->with(
                'error',
                'Only admins can create managers.'
            );
        }

        /*
        Create user
        */

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => strtolower($request->position)
        ]);

        /*
        Create staff
        */

        Staff::create([
            'staff_id' => $request->staff_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'nin' => $request->nin,
            'position' => $request->position,
            'salary' => $request->salary,
            'date_joined' => $request->date_joined,
            'branch_id' => $request->branch_id,
            'supervisor_id' => $request->supervisor_id,
            'user_id' => $user->id
        ]);

        return redirect()
            ->route('staff.show', $request->staff_id)
            ->with('success', 'Staff created successfully.');
    }

    public function show($id)
    {
        $staff = Staff::with('nextOfKin', 'user')
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
            'phone' => $request->phone
        ]);

        return redirect()
            ->route('staff.show', $id)
            ->with('success', 'Next of kin added.');
    }
}