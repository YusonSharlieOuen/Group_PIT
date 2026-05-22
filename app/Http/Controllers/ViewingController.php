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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = PropertyDetails::all();
        $renters = Renter::all();

        return view('Viewing.create_viewing', compact(
            'properties',
            'renters'
        ));
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
        $viewings = Viewing::where('property_id', $id)->with('renter')->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Viewing $viewing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viewing $viewing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viewing $viewing)
    {
        //
    }
}
