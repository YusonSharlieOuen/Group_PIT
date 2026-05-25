<?php

namespace App\Http\Controllers;

use App\Models\PropertyDetails;
use App\Models\Renter;
use App\Models\Viewing;
use Illuminate\Http\Request;

class ViewingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewings = Viewing::with(['renter', 'propertyDetails'])->get();

        return view('Admin.viewings.index', compact('viewings'));
    }

    public function calendar()
    {
        $viewings = Viewing::with(['renter', 'propertyDetails'])->get();

        return view('Admin.viewings.calendar', compact('viewings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = PropertyDetails::all();
        $renters = Renter::all();

        return view('Viewing.create_viewing', compact('properties', 'renters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'renter_id' => 'required',
            'viewing_date' => 'required|date',
            'comments' => 'nullable|string',
        ]);

        Viewing::create([
            'property_id' => $request->property_id,
            'renter_id' => $request->renter_id,
            'viewing_date' => $request->viewing_date,
            'comments' => $request->comments,
        ]);

        return back()->with('success', 'Viewing added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Viewing $viewing)
    {
        $viewing->load(['renter', 'propertyDetails']);

        return view('Admin.viewings.show', compact('viewing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Viewing $viewing)
    {
        $properties = PropertyDetails::all();
        $renters = Renter::all();

        return view('Admin.viewings.edit', compact('viewing', 'properties', 'renters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viewing $viewing)
    {
        $request->validate([
            'property_id' => 'required|exists:property,property_id',
            'renter_id' => 'required|exists:renter,renter_id',
            'viewing_date' => 'required|date',
            'comments' => 'nullable|string',
        ]);

        $viewing->update([
            'property_id' => $request->property_id,
            'renter_id' => $request->renter_id,
            'viewing_date' => $request->viewing_date,
            'comments' => $request->comments,
        ]);

        return redirect()->route('admin.viewings.index')->with('success', 'Viewing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viewing $viewing)
    {
        $viewing->delete();

        return redirect()->route('admin.viewings.index')->with('success', 'Viewing deleted successfully.');
    }
}

