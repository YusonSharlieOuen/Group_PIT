<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Staff;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.manager_dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Staff::create([
            'staff_id' => $request->input('staff_id'),
            'first_name' => $request->input('first_name'),
            'position' => $request->input('position'),

            'branch_id' => auth()->user()->branch_id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
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
